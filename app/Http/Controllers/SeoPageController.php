<?php

namespace App\Http\Controllers;

use App\Models\LotcasesCategory;
use App\Models\SeoPage;
use App\Models\Share;
use Carbon\Carbon;
use Illuminate\Http\Request;

class SeoPageController extends Controller
{

    public function show($slug)
    {
        $seo_category = SeoPage::where('slug', $slug)->with(['activeLotcases' => function ($query) {
            $query->withTranslations();
        }])->first()->translate();
        $title = $seo_category->title;
        $description = $seo_category->description;
//        $categories = LotcasesCategory::where('active', 1)->where('position', '!=', 0)->orderBy('position', 'asc')->with('activeLotcases')->get();
        $share = Share::select("*")
            ->where('start', '<', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('end', '>', Carbon::now()->format('Y-m-d H:i:s'))
            ->where('status', 1)
            ->first();
        $share_category = LotcasesCategory::where('active', 1)->where('position', '=', 0)->first()->translate();
//        $share = null;
        $seo_pages = SeoPage::whereActive(1)->get()->translate();

        return view('main', compact('share', 'share_category', 'seo_category', 'seo_pages', 'title', 'description'));

    }

}

