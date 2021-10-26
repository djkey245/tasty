<?php

namespace App\Http\Controllers;

use App\Helpers\WeekHelper;
use App\Http\Requests\TopUserGetRequest;
use App\Models\PrizeItem;
use App\Models\Rank;
use App\Models\Score;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TopUsersController extends Controller
{
    public function show(TopUserGetRequest $request)
    {

        $ranks = Rank::all()->translate();

        $title = trans('titles.top-users');

        $week = $request->week ? intval($request->week) : WeekHelper::todayWeek();
        $year = WeekHelper::todayYear();
        $lastScoreDate = Score::oldestDateThisYear();

        $startWeekDay = WeekHelper::getStartWeekDay($week, $year);
        $endWeekDay = WeekHelper::getEndWeekDay($week, $year);


        $topUserScore = User::topScoreUsers($week, $year, $startWeekDay, $endWeekDay, $lastScoreDate);

        $weekOptions = WeekHelper::generateWeeksOptions($lastScoreDate);

        $user = Auth::user();
        $usersCount = User::count();
        $userName = $user ? $user->name : null;
        $userScore = $user ? $user->weekScore($startWeekDay, $endWeekDay) : null;

        $endWeekDiff = $endWeekDay->diff(Carbon::now());
        $timerEnable = boolval($endWeekDiff->invert);

        $prizes = PrizeItem::all()->sortBy('order')->groupBy('place');


        return view('top_users',
            compact(
                'ranks',
                'title',
                'topUserScore',
                'weekOptions',
                'week',
                'usersCount',
                'userScore',
                'userName',
                'endWeekDiff',
                'timerEnable',
                'prizes'
            )
        );
    }

}
