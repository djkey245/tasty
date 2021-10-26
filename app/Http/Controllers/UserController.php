<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Rank;
use App\Models\User;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{


    public function show()
    {
        $user = Auth::user();

        $ranks = Rank::orderBy('start_score', 'asc')->get()->translate();
        $questions = Question::all()->translate()->sortBy('order');
        return view('account', compact('user', 'ranks', 'questions'));

    }

    public function saveLink(Request $request)
    {
        $data = $request->all();
        $user = Auth::user();
        if ($data['link_o'] == "") {
            $user->update(['link_o' => $data['link_o']]);
            return response()->json(['title' => trans('http/controller.great'), 'message' => trans('http/controller.link_o_save')]);
        }
        if (substr_count($data['link_o'], 'https://') == 1) {
            if (substr_count($data['link_o'], 'steamcommunity.com/tradeoffer/new/') == 1) {
                if (substr_count($data['link_o'], '?partner=') == 1) {
                    if (substr_count($data['link_o'], '&token=') == 1) {

                        if (User::where('link_o', 'like', '%' . $data['link_o'] . '%')->first()) {
                            return response()->json(['title' => trans('http/controller.error_in_link'), 'message' => trans('http/controller.link_o_not_save')], 400);
                        }
                        $user->update(['link_o' => $data['link_o']]);
                        return response()->json(['title' => trans('http/controller.great'), 'message' => trans('http/controller.link_o_save')]);
                    }
                }
            }
        }
        return response()->json(['title' => trans('http/controller.error_in_link'), 'message' => trans('http/controller.link_o_not_save')], 400);

    }

    public function showBySlug($userSlug)
    {
        $user = User::where('slug', $userSlug)->firstOrFail();
        $ranks = Rank::orderBy('start_score', 'asc')->get()->translate();
        $questions = Question::all()->translate()->sortBy('order');
        $readOnly = true;
        $title = trans('titles.watch-account', ['nickname' => $user->name, 'tasty-url' => trans('project_defs.url')]);
        $description = trans('descriptions.watch-account');
        return view('account',
            compact(
                'user',
                'ranks',
                'questions',
                'readOnly',
                'title',
                'description'
            )
        );
    }

}
