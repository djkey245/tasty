<?php


namespace App\Helpers;



class CheckLangHelper
{
    public static function checkIfLangAvailable(string $lang): bool
    {
        $langs = array_keys(config('laravellocalization.supportedLocales'));
        return in_array($lang, $langs);
    }
}
