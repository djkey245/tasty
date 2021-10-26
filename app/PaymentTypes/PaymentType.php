<?php


namespace App\PaymentTypes;


use App\Helpers\ConvertHelper;
use App\Models\LangPriceMultiplier;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

abstract class PaymentType implements PaymentTypeInterface
{
    protected $defaultCurrency = 'USD';

    public function convertSumToCurrency(float $value, string $fromCurrency = null, string $toCurrency = null): float
    {
        if ($fromCurrency === $toCurrency) return $value;
        $fromCurrency = $fromCurrency ?? $this->defaultCurrency;
        $toCurrency = $toCurrency ?? $this->defaultCurrency;

        $fromCurrencyMultiplier = LangPriceMultiplier::getMultiplierByCurrency($fromCurrency);
        $toCurrencyMultiplier = LangPriceMultiplier::getMultiplierByCurrency($toCurrency);
        return ConvertHelper::convertValue($value, $fromCurrencyMultiplier, $toCurrencyMultiplier);
    }

    public function calculateCreateFormAmount($amount): float
    {

        return $this->convertSumToCurrency(
            $amount,
            LangPriceMultiplier::getCurrencyByLang(App::getLocale()),
            $this->defaultCurrency
        );
    }


    public function amountToServer($amount, $currency = null): float
    {
        $currency = $currency ?? $this->defaultCurrency;
        return $this->convertSumToCurrency(
            $amount,
            $currency,
            LangPriceMultiplier::$serverCurrency
        );
    }

    abstract public function create(Payment $payment): string;

    abstract public function callback(Request $request);

}
