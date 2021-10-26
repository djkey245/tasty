<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Paymentwall_Config;

class PaymentwallServiceProvider extends ServiceProvider
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
    public function boot()
    {
        Paymentwall_Config::getInstance()->set([
            'api_type' => Paymentwall_Config::API_GOODS,
            'public_key' => config('services.paymentwall.public_key'),
            'private_key' => config('services.paymentwall.private_key'),
        ]);
    }
}
