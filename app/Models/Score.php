<?php

namespace App\Models;

use App\Helpers\WeekHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Score extends Model
{
    use HasFactory;

    public static function create(User $user, LotcaseOpened $lotcaseOpened)
    {
        $score = new self();
        $score->sum = $lotcaseOpened->case_price;
        $score->score = $score->sum * self::getScoreCoefficient();
        $score->user_id = $user->id;
        $score->lotcase_opened_id = $lotcaseOpened->id;
        $score->save();

        $user->score += $score->score;
        $user->save();

    }

    public static function getScoreCoefficient(): float
    {
        $value = setting('site.score_coef');
        return $value ? floatval($value) : 1;
    }

    public static function topScoreGroupedByUser($dateStart, $dateEnd, int $topCount = 10): Collection
    {
        return self::query()
            ->whereBetween('created_at', [$dateStart, $dateEnd])
            ->groupBy('user_id')
            ->select('user_id', DB::raw('SUM(score) as score_sum'))
            ->orderByDesc('score_sum')
            ->limit($topCount)
            ->get();
    }

    public static function oldestDateThisYear(): ?Carbon
    {
        $oldestScore = self::where('created_at', '>', Carbon::now()->year)->oldest()->first();
        return $oldestScore ? $oldestScore->created_at : null;
    }


}
