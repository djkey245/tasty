<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Gamemoney\Gateway;
use Gamemoney\Config;

class GamemoneyGatewayServiceProvider extends ServiceProvider
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
        $this->app->singleton(Gateway::class, function ($app) {
            $config = new Config(config('services.gamemoney.project_id'), config('services.gamemoney.hmac_secret'));

            return new Gateway($config);
        });
        //
    }
}
