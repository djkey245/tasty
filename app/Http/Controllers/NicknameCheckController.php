<?php

namespace App\Http\Controllers;

use App\Helpers\ConvertHelper;
use App\Helpers\FindTastyHelper;
use App\Models\NicknameCheck;
use App\Models\User;
use App\Services\SteamApiService;
use Carbon\Carbon;
use Carbon\Traits\Creator;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NicknameCheckController extends Controller
{
    public function showButton()
    {
        $checkResult = Auth::check() ? app()->call([$this, 'checkNickname']) : [
            'disableButton' => true,
            'message' => ''
        ];
        $dayArray = [1, 2, 5, 10, 30, 360];
        return view('nickname-check', [
            'checkResult' => $checkResult,
            'daysArray' => $dayArray,
            'rewardPerClick' => ConvertHelper::convertValue(setting('admin.nickname_check_reward')),
            'title' => trans('titles.nickname-check'),
        ]);
    }

    public function checkNickname(SteamApiService $steamApiService, FindTastyHelper $findTastyHelper, Request $request)
    {
        $user = Auth::user();
        $lastCheck = $user->lastNicknameCheck;
        if ($lastCheck) {
            $time = Carbon::parse($lastCheck->created_at)
                ->addHours(24)
                ->diff(Carbon::now());

            return [
                'message' => trans('http/nickname_check.alreadyUsed', ['time' => $time->format('%H:%I')]),
                'buttonDisabled' => true
            ];
        }
        if (!$request->get('activate')) return [
            'message' => '',
            'buttonDisable' => false,
        ];
        try {
            $rightName = $findTastyHelper->findTasty($steamApiService->getUserName($user->provider_uid));
        } catch (\Exception $exception) {
            return [
                'message' => trans('http/nickname_check.error'),
                'buttonDisabled' => false,
            ];
        }
        if (!$rightName) {
            return [
                'message' => trans(
                    'http/nickname_check.wrongNickname',
                    ['tasty' => $findTastyHelper->searchStr]
                ),
                'buttonDisabled' => false,
            ];
        }

        $newNicknameCheck = new NicknameCheck();
        $newNicknameCheck->sum = setting('admin.nickname_check_reward');
        $newNicknameCheck->user_id = $user->id;
        $newNicknameCheck->save();
        $user->topUpBalanceByNicknameCheck($newNicknameCheck);

        return [
            'message' => trans('http/nickname_check.allGood'),
            'buttonDisabled' => true
        ];


    }
    //
}
