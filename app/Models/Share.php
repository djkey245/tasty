<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Share extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['title'];

    protected $dates = ['start', 'end'];


    public function getTimeLeftAttribute()
    {
        $all_seconds = Carbon::parse($this->end)->diffInSeconds(now());
        $seconds_in_day = 24 * 60 * 60;
        $days = intdiv($all_seconds, $seconds_in_day);
        $all_seconds = $all_seconds - $seconds_in_day * $days;
        $seconds_in_hour = 60 * 60;
        $hours = intdiv($all_seconds, $seconds_in_hour);
        $all_seconds = $all_seconds - $seconds_in_hour * $hours;
        $minutes = intdiv($all_seconds, 60);
        $seconds = $all_seconds - 60 * $minutes;

        if ($minutes < 10) {
            $minutes = '0' . $minutes;
        }
        if ($seconds < 10) {
            $seconds = '0' . $seconds;
        }
        return $days . 'd  ' . $hours . ':' . $minutes . ':' . $seconds;
    }
}
