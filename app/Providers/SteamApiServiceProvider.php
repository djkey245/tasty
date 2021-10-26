<?php

namespace App\Providers;

use App\Services\SteamApiService;
use Illuminate\Support\ServiceProvider;

class SteamApiServiceProvider extends ServiceProvider
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
        $this->app->singleton(SteamApiService::class, function ($app) {
            return new SteamApiService($app['config']['services']['steam']['client_secret']);
        });
        //
    }
}
