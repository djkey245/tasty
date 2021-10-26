<?php

namespace App\Providers;

use App\Services\P24ApiService;
use Illuminate\Support\ServiceProvider;

class P24ApiServiceProvider extends ServiceProvider
{
    protected $defer = true;

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->singleton(P24ApiService::class, function ($app) {

            return new P24ApiService(
                config('services.p24.merchant_id'),
                config('services.p24.key_to_reports'),
                config('services.p24.crc'),
                config('services.p24.productionMode')
            );
        });
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
    }

    public function provides()
    {
        return [P24ApiService::class];
    }
}
