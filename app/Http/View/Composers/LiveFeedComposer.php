<?php

namespace App\Http\View\Composers;

use App\Models\LotcaseOpened;
use Illuminate\View\View;

class LiveFeedComposer {

    protected $livefeed;


    public function __construct()
    {
        $this->livefeed = LotcaseOpened::orderBy('created_at','desc')->take(10)->with('item')->get();

    }


    public function compose(View $view)
    {
        $view->with('livefeed', $this->livefeed);
    }
}
