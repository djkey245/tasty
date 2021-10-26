<?php

namespace App\Listeners;

use App\Events\StatCountUpdate;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;

class SendStatUpdateNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param StatCountUpdate $event
     * @return void
     */
    public function handle(StatCountUpdate $event)
    {
        return $event;
        //
    }
}
