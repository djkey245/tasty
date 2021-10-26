<?php

namespace App\Providers;

use App\Http\View\Composers\GiveAwayComposer;
use App\Http\View\Composers\HeaderStatComposer;
use App\Http\View\Composers\LangSelectComposer;
use App\Http\View\Composers\LiveFeedComposer;
use App\Http\View\Composers\PaymentTypeComposer;
use App\Http\View\Composers\TopCaseOpensComposer;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('main', GiveAwayComposer::class);
        View::composer('layout.header.stat', HeaderStatComposer::class);
        View::composer('layout.header.livefeed', LiveFeedComposer::class);
        View::composer('layout.cases.top-case-opens', TopCaseOpensComposer::class);
        View::composer('layout.payment.payment-types', PaymentTypeComposer::class);
        View::composer(['layout.header.lang-select', 'layout.header.header-lang-meta'], LangSelectComposer::class);
    }
}
