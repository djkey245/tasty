<?php

namespace App\Providers;

use App\Events\StatCountUpdate;
use App\Listeners\OpeningLotCaseNotification;
use App\Listeners\SendStatUpdateNotification;
use App\Models\LotcaseOpened;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        LotcaseOpened::class => [
            OpeningLotCaseNotification::class
        ],
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        \SocialiteProviders\Manager\SocialiteWasCalled::class => [
            // add your listeners (aka providers) here
            'SocialiteProviders\\Zoho\\ZohoExtendSocialite@handle',
            'SocialiteProviders\\Steam\\SteamExtendSocialite@handle',

        ],
        StatCountUpdate::class => [
            SendStatUpdateNotification::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
    }
}
