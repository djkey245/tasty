<?php


namespace App\Traits;


use App\Models\LangPriceMultiplier;
use Illuminate\Support\Facades\App;

trait PriceModifierTrait
{
    public function getModifiedPriceAttribute()
    {
        return $this->getMultiplied('price');
    }

    public function getModifiedBalanceAttribute()
    {
        return $this->getMultiplied('balance');
    }

    public function getModifiedSumAttribute()
    {
        return $this->getMultiplied('sum');
    }

    public function getModifiedConvertedSumAttribute()
    {
        return $this->getMultiplied('converted_sum');
    }

    private function getMultiplied(string $attribute)
    {
        if (!$this->isAttributeExist($attribute)) return 0;

        return number_format(
            floatval(
                $this->attributes[$attribute]) * LangPriceMultiplier::getMultiplier(App::getLocale()),
            2
        );
    }

    private function isAttributeExist(string $attribute): bool
    {
        return isset($this->attributes[$attribute]);
    }

}
