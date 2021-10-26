<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\OpenRandomCaseRequest;
use App\Models\Lotcase;
use App\Models\Role;
use App\Models\User;
use App\Services\OpenCaseService;
use Illuminate\Http\Request;

class CaseController extends Controller
{
    public function openRandomCase(OpenRandomCaseRequest $request)
    {
        $user = User::find($request->user_id);
        if ($user->role->name !== Role::$botRoleName)
            return $request->response(500, ['message' => 'only for bots']);
        foreach (range(1, $request->count) as $count)
            Lotcase::query()->inRandomOrder()->first()->openCase($user);
        return response('Ok');
    }

    public function checkValueFromCase(Request $request, Lotcase $case, OpenCaseService $openCaseService)
    {
        $count = $request->count;
        $itemSum = 0;
        foreach (range(1, $count) as $index) {
            $item = $openCaseService->generate($case, false);
            $itemSum += $item->price;
        }
        return response()->json([
            'itemSum' => $itemSum,
            'caseSum' => $case->price * $count
        ]);

    }
}
