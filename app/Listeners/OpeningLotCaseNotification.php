<?php

namespace App\Listeners;

use App\Events\LotCaseOpen;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class OpeningLotCaseNotification
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
     * @param LotCaseOpen $event
     * @return void
     */
    public function handle(LotCaseOpen $event)
    {

        return $event;
    }
}
