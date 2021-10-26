<?php

namespace App\Providers;

use App\PaymentTypes\UnitPayPaymentType;
use Illuminate\Support\ServiceProvider;

class UntPayPaymentTypeProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(\UnitPay $unitPay)
    {
        $this->app->singleton(UnitPayPaymentType::class, function () use ($unitPay) {
            return new UnitPayPaymentType($unitPay);
        });
    }
}
