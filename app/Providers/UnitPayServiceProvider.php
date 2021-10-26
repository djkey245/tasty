<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use UnitPay;

class UnitPayServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton(UnitPay::class, function () {
            return new UnitPay('unitpay.ru', config('unitpay.secret-key'));
        });
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
