<?php


namespace App\Http\View\Composers;


use App\Models\LotcaseOpened;
use Illuminate\View\View;

class TopCaseOpensComposer
{
    private $topCaseOpens;

    public function __construct()
    {
        $this->topCaseOpens = LotcaseOpened::topDrop();
    }

    public function compose(View $view)
    {
        $view->with('topCaseOpens', $this->topCaseOpens);
    }
}
