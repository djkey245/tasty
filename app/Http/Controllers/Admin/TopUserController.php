<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\WeekHelper;
use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;

class TopUserController extends Controller
{
    public function show()
    {
        $topUsersInTable = User::topScoreUsers(WeekHelper::todayWeek(), WeekHelper::todayYear());
        $botList = Role::getBotUsers();


        return view('admin.top-users', compact('topUsersInTable', 'botList'));
    }
}
