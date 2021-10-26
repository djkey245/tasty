<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\UserItem;
use Illuminate\Http\Request;

class MainController extends Controller
{
    public function changeItemStatus(UserItem $userItem, Request $request)
    {
        if ($request->has('status') && !empty($request->get('status'))) {
            $userItem->update(['status' => $request->get('status')]);
            return response()->json();
        } else {
            return response()->json('', 400);
        }
    }
}
