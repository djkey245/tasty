<?php

namespace App\Http\Controllers;

use App\Http\Requests\HomeRequest;
use App\Models\LoginMessage;
use App\Models\LotcasesCategory;
use App\Models\SeoPage;
use App\Models\Share;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        parent::__construct();


    }

    public function show(HomeRequest $request)
    {

        $categories = LotcasesCategory::where('active', 1)
            ->where('position', '!=', 0)
            ->orderBy('position', 'asc')
            ->with(['activeLotcases' => function ($query) {
                $query->withTranslations();
            }])->get()->translate();
        $share = Share::select("*")
            ->where('start', '<', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('end', '>', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('status', 1)
            ->first();
        $share_category = LotcasesCategory::where('active', 1)->where('position', '=', 0)->first();
        $seo_pages = SeoPage::whereActive(1)->get()->translate();
        $title = trans('titles.home');
        $writeMessage = $request->writeMessage;
        $messages = $writeMessage ? LoginMessage::authMessages()->all() : [];
        return view('main', compact(
            'categories',
            'share',
            'share_category',
            'seo_pages',
            'title',
            'messages',
            'writeMessage'));
    }
    public function showAuth(HomeRequest $request)
    {

        $categories = LotcasesCategory::where('active', 1)
            ->where('position', '!=', 0)
            ->orderBy('position', 'asc')
            ->with(['activeLotcases' => function ($query) {
                $query->withTranslations();
            }])->get()->translate();
        $share = Share::select("*")
            ->where('start', '<', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('end', '>', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('status', 1)
            ->first();
        $share_category = LotcasesCategory::where('active', 1)->where('position', '=', 0)->first();
        $seo_pages = SeoPage::whereActive(1)->get()->translate();
        $title = trans('titles.home');
        $writeMessage = $request->writeMessage;
        $messages = $writeMessage ? LoginMessage::authMessages()->all() : [];
        return view('main-auth', compact(
            'categories',
            'share',
            'share_category',
            'seo_pages',
            'title',
            'messages',
            'writeMessage'));
    }


}
