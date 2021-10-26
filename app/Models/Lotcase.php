<?php

namespace App\Models;

use App\Events\LotCaseOpen;
use App\Exceptions\CaseExceptions\AlreadyOpenTodayDailyException;
use App\Exceptions\CaseExceptions\FirstCaseOpenOnlyException;
use App\Exceptions\CaseExceptions\MinPaymentSumForDailyException;
use App\Exceptions\CaseExceptions\MinPaymentSumRequiredException;
use App\Services\OpenCaseService;
use App\Traits\PriceModifierTrait;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Lotcase extends Model
{
    use HasFactory;
    use Translatable;
    use PriceModifierTrait;

    protected $translatable = ['title', 'description', 'seo_title', 'seo_description'];

    public static $defaultCaseType = 0;

    public static $firstCaseType = 3;

    public static $onePerDayType = 1;


    public function items()
    {

        return $this->hasMany(Item::class);
    }

    public function activeItems()
    {

        return $this->hasMany(Item::class, 'lotcase_id', 'id')->whereActive(1)->where('price', '>', '0');
    }

    public function checkUser($user): bool
    {
        if ($user->itsBot()) return true;
        switch ($this->type) {
            case self::$defaultCaseType;
                return $this->checkUserDefaultCase($user);
            case self::$onePerDayType;
                return $this->checkUserOnePerDayCase($user);
            case self::$firstCaseType:
                return $this->checkUserFirstCase($user);
        }
        return true;
    }


    public function checkUserDefaultCase(User $user): bool
    {
        $paymentSum = $user->paymentSum();
        if ($paymentSum < Payment::$minPayment) {
            throw new MinPaymentSumRequiredException();
        }
        return true;
    }

    public function checkUserFirstCase(User $user): bool
    {
        $count = $user->items()->where('lotcase_id', $this->id)->count();
        if ($count > 0) {
            throw new FirstCaseOpenOnlyException();
        }
        return true;
    }

    public function checkUserOnePerDayCase(User $user): bool
    {

        $dayBehind = Carbon::now()->subDay();
        $lastCaseQuery = $user
            ->cases()
            ->where('lotcase_id', $this->id)
            ->where('created_at', '>', $dayBehind);
        if ($lastCaseQuery->exists()) {
            $lastCaseDate = $lastCaseQuery->first()->created_at;
            $diff = Carbon::make($lastCaseDate)->diff($dayBehind);
            throw new AlreadyOpenTodayDailyException($diff->format('%H:%I'));
        }
        $paymentSumForLastWeek = $user->paymentSumForLastWeek();
        if ($paymentSumForLastWeek < Payment::$minPayment)
            throw new MinPaymentSumForDailyException();
        return true;
    }

    public function openCase(User $user, $fastOpen = false)
    {
        $this->checkUser($user);
        $service = new OpenCaseService();
        $drop = $service->generate($this);
        event(new LotCaseOpen($drop, $fastOpen));

        $price = $user->spendBalance($this->price);

        $user_drop = $user->addToUserDrop($drop, $this);

        $lotcaseOpened = new LotcaseOpened([
            'lotcase_id' => $this->id,
            'item_id' => $drop->id,
            'item_price' => $drop->price,
            'case_price' => $price,
        ]);
        $user->cases()->save($lotcaseOpened);
        Score::create($user, $lotcaseOpened);
        return [
            "success" => $drop,
            "balance" => $user->modified_balance,
            "hearts" => $user->hearts,
            "rank" => $user->getRank(),
            "price" => $this->modified_price,
            "user_drop" => $user_drop
        ];
    }
}
