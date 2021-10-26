<?php


namespace App\Helpers;


use App\Models\LangPriceMultiplier;
use Illuminate\Support\Facades\App;

class ConvertHelper
{
    public static function convertValue(float $value, float $fromMultiplier = null, float $toMultiplier = null): float
    {
        $fromMultiplier = $fromMultiplier ?? 1;
        $toMultiplier = $toMultiplier ?? LangPriceMultiplier::getMultiplier(App::getLocale());

        return $toMultiplier * $value / $fromMultiplier;
    }
}
