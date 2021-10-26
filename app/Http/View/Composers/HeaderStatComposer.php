<?php

namespace App\Http\View\Composers;

use App\Models\LotcaseOpened;
use App\Models\User;
use App\Models\UserItem;
use Illuminate\View\View;

class HeaderStatComposer
{

    protected $stat;


    public function __construct()
    {
        $stat = collect();
        $stat->case_opened = LotcaseOpened::select('id')->count();
        $stat->contracts = UserItem::select('id,is_contract')->where('is_contract', 1)->count();
        $stat->user_count = User::select('id')->count();
        $stat->user_count_today = User::userCountToday();
        $this->stat = $stat;
    }


    public function compose(View $view)
    {
        $view->with('stat', $this->stat);
    }
}
