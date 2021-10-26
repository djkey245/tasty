<?php

namespace App\Models;

use App\Events\StatCountUpdate;
use App\Exceptions\UserExceptions\NoBalanceException;
use App\Helpers\WeekHelper;
use App\Traits\PriceModifierTrait;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class User extends \TCG\Voyager\Models\User
{
    use HasFactory, Notifiable;
    use PriceModifierTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected static function boot()
    {
        parent::boot();
        self::created(function () {
            event(new StatCountUpdate('user_count'));
        });
    }

    protected $fillable = [
        'name',
        'slug',
        'provider',
        'provider_uid',
        'balance',
        'score',
        'hearts',
        'email',
        'link_o',
        'img',
        'role_id',
        'vip',
        'ban',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    //Mutators

    public function setPasswordAttribute()
    {
        $random = str_shuffle('abcdefghjklmnopqrstuvwxyzABCDEFGHJKLMNOPQRSTUVWXYZ234567890!$%^&!$%^&');
        $password = substr($random, 0, 12);
        $this->attributes['password'] = bcrypt($password);
    }

    public function setSlugAttribute($name)
    {
        if (static::whereSlug($slug = Str::slug($name))->exists()) {

            $slug = $this->incrementSlug($slug);
        }
        $this->attributes['slug'] = $slug;
    }


    //Helpers
    private function incrementSlug($slug)
    {

        $original = $slug;

        $count = 2;

        while (static::whereSlug($slug)->exists()) {

            $slug = "{$original}-" . $count++;
        }

        return $slug;

    }

    public function getRank()
    {

        $fieldsToSelect = ['rating', 'rank', 'rank_img', 'level', 'end_score'];
        $resultQuery = Rank::query()
            ->select($fieldsToSelect)
            ->where('start_score', '<=', $this->score)
            ->where('end_score', '>=', $this->score);

        if ($resultQuery->exists())
            return $resultQuery->first();

        return Rank::query()->orderByDesc('end_score')->select($fieldsToSelect)->first();
    }


    public function items()
    {
        return $this->hasMany(UserItem::class, 'user_id', 'id');
    }

    public function cases()
    {
        return $this->hasMany(LotcaseOpened::class, 'user_id', 'id');
    }

    public function promocodes()
    {

        return $this->hasMany(PromocodesUser::class, 'user_id', 'id');
    }

    public function payments()
    {

        return $this->hasMany(Payment::class, 'user_id', 'id');
    }

    public function nicknameCheck()
    {
        return $this->hasMany(NicknameCheck::class);
    }

    public function lastNicknameCheck()
    {
        return $this->hasOne(NicknameCheck::class)
            ->where('created_at', '>', Carbon::now()->subHours(24))
            ->latest();
    }

    public function addMoney(Payment $payment, $out_summ, $divider = 1)
    {

        $out_summ += $this->promocodeUse($out_summ);
        $out_summ = $out_summ / $divider;
        $this->addSumToBalance(floatval($out_summ));

        $payment->update(['status' => 1]);

    }

    public function topUpBalanceByNicknameCheck(NicknameCheck $nicknameCheck)
    {
        $this->addSumToBalance($nicknameCheck->sum);
    }


    private function promocodeUse(float $sum): float
    {
        try {
            if ($this->promocodes->isNotEmpty()) {
                $active_promo = $this->promocodes->sortByDesc('id')->first();
                PromocodesUser::where(['user_id' => $active_promo->user_id, 'promocode' => $active_promo->name])->update(['active' => 0]);
                return (($sum * $active_promo->discount) / 100);
            }
        } catch
        (\Exception $e) {
            Log::debug("PROMOCODE ERROR!!!");
            Log::debug($e);
        }
        return 0;
    }

    public function addSumToBalance(float $sum)
    {
        $this->balance += $sum;
        $this->hearts += $sum * floatval(setting('hearts.heart_for_add_balance', 0.1));
        $this->save();
    }

    public function spendBalance(float $sum)
    {
        if ($this->itsBot()) $this->addSumToBalance($sum);

        $rank = $this->getRank();

        if ($rank) {
            $sum = $sum - ($sum * ($rank->disc / 100));
        }
        $this->balance -= $sum;
        if ($this->balance < 0) throw new NoBalanceException();
        $this->hearts += ($sum * floatval(setting('hearts.heart_for_spend_balance', 0.05)));
        $this->save();
        return $sum;
    }

    public function addToUserDrop(Item $item, Lotcase $case): UserItem
    {
        return $this->items()->save(new UserItem([
            'item_id' => $item->id,
            'lotcase_id' => $case->id,
            'price' => $item->price,
            'status' => $case->type === Lotcase::$firstCaseType ? 'fcase' : 'wait'
        ]));
    }

    public function paymentSum()
    {
        return $this->payments()->paidStatus()->sum('converted_sum');
    }

    public function paymentSumForLastWeek(): float
    {
        return $this
            ->payments()
            ->paidStatus()
            ->where('created_at', '>', Carbon::now()->subDays(7))
            ->sum('converted_sum');
    }

    public function scores()
    {
        return $this->hasMany(Score::class);
    }

    public function weekScore($dateStart, $dateEnd)
    {
        return $this->scores()
            ->whereBetween('created_at', [$dateStart, $dateEnd])
            ->sum('score');
    }

    public static function topScoreUsers($week, $year, $startWeekDay = null, $endWeekDay = null, $lastScoreDate = null): Collection
    {

        $startWeekDay = $startWeekDay ?? WeekHelper::getStartWeekDay($week, $year);
        $endWeekDay = $endWeekDay ?? WeekHelper::getEndWeekDay($week, $year);

        $lastScoreDate = $lastScoreDate ?? Score::oldestDateThisYear();

        WeekHelper::checkIfWeekAvailable($week, $lastScoreDate);

        $topUserScore = Score::topScoreGroupedByUser($startWeekDay, $endWeekDay)->keyBy('user_id');

        $topUsers = User::whereIn('id', $topUserScore->pluck('user_id'))->get();

        $topUsers->map(function ($element) use ($topUserScore) {
            $currentUser = $topUserScore[$element->id];
            $element->score_sum = $currentUser->score_sum;
        });
        return $topUsers->sortByDesc('score_sum');
    }

    public function itsBot()
    {
        return $this->role->name === Role::$botRoleName;
    }

    public function getLastWeekScoreAttribute()
    {
        return $this->weekScore(WeekHelper::getStartWeekDay(), WeekHelper::getEndWeekDay());
    }

    public static function userCountToday(): int
    {
        return self::query()->whereDate('created_at', Carbon::today())->count();
    }

    public function quests()
    {
        return $this->belongsToMany(Quest::class);
    }


}
