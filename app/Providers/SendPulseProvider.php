<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Sendpulse\RestApi\ApiClient;

class SendPulseProvider extends ServiceProvider
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
        $this->app->singleton(ApiClient::class, function ($app) {
            return new ApiClient(
                $app['config']['sendpulse']['user_id'],
                $app['config']['sendpulse']['secret']
            );
        });
    }
}
