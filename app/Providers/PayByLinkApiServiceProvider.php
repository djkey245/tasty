<?php

namespace App\Providers;

use App\Services\PayByLinkApiService;
use Illuminate\Support\ServiceProvider;

class PayByLinkApiServiceProvider extends ServiceProvider
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
        $this->app->singleton(PayByLinkApiService::class, function () {
            return new PayByLinkApiService(
                config('services.paybylink.secure_code'),
                config('services.paybylink.shop_id')
            );
        });
        //
    }
}
