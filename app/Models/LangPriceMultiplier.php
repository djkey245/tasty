<?php

namespace App\Models;

use Illuminate\Support\Facades\Cache;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LangPriceMultiplier extends Model
{
    use HasFactory;

    public static $serverCurrency = 'USD';

    public static function getMultiplier(string $lang): string
    {
        return Cache::remember("multipliers_$lang", 60,
            function () use ($lang) {
                $multiplierObj = self::where('lang', $lang)->first('multiplier');

                return $multiplierObj ? $multiplierObj->multiplier : 1;
            });
    }

    public static function getMultiplierByCurrency(string $currency): string
    {
        return Cache::remember("mutlipliers_$currency", 60,
            function () use ($currency) {
                $multiplier = self::where('currency', $currency)->first();

                return $multiplier ? $multiplier->multiplier : 1;
            });
    }

    public static function getCurrencyByLang(string $lang): string
    {
        return Cache::remember("currency_$lang", 60, function () use ($lang) {
            $currency = self::where('lang', $lang)->first();

            return $currency ? $currency->currency : self::$serverCurrency;
        });
    }
}
