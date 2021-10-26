<?php


namespace App\Helpers;


use App\Models\Score;
use Carbon\Carbon;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

class WeekHelper
{
    public static function firstWeek(Carbon $lastScoreDate): int
    {
        return $lastScoreDate->weekOfYear;

    }

    public static function todayYear(): int
    {
        return Carbon::now()->year;
    }

    public static function todayWeek(): int
    {
        return Carbon::now()->weekOfYear;
    }

    public static function checkIfWeekAvailable(int $week, Carbon $lastScoreDate): void
    {
        $firstWeek = WeekHelper::firstWeek($lastScoreDate);
        $lastWeek = WeekHelper::todayWeek();

        if ($week < $firstWeek || $week > $lastWeek)
            throw new NotFoundHttpException();
    }

    public static function getStartWeekDay(int $week = null, int $year = null): Carbon
    {
        $week = $week ?? self::todayWeek();
        $year = $year ?? self::todayYear();
        $date = Carbon::now()->setISODate($year, $week);
        return $date->startOfWeek();
    }

    public static function getEndWeekDay(int $week = null, int $year = null): Carbon
    {
        $week = $week ?? self::todayWeek();
        $year = $year ?? self::todayYear();
        $date = Carbon::now()->setISODate($year, $week);
        return $date->endOfWeek();
    }

    public static function generateWeeksOptions(Carbon $lastScoreDate): array
    {
        $firstWeek = self::firstWeek($lastScoreDate);
        $lastWeek = self::todayWeek();
        $todayYear = self::todayYear();

        $result = [];

        foreach (range($firstWeek, $lastWeek + 1) as $week) {
            array_unshift($result, [
                'value' => $week,
                'text' => self:: formatToWeekOption(self::getStartWeekDay($week, $todayYear))
                    . ' - ' . self:: formatToWeekOption(self::getEndWeekDay($week, $todayYear))
            ]);
        }

        return $result;
    }

    public static function formatToWeekOption(Carbon $date)
    {
        return $date->format('d / m');
    }


}
