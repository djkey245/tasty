<?php

namespace App\Http\View\Composers;

use App\Models\GiveAway;
use Illuminate\View\View;

class GiveAwayComposer {

    protected $giveaway;


    public function __construct()
    {
        $this->giveaway = GiveAway::where('active', 1)->where('end','>', now())->first()->translate();
    }


    public function compose(View $view)
    {
        $view->with('giveaway', $this->giveaway);
    }
}
