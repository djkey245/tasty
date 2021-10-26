<?php

namespace App\Http\Controllers;

use App\Models\Quest;
use App\Quests\QuestFactory;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class QuestController extends Controller
{

    public function show()
    {
        $user = Auth::user();
        $quests = [];
        if ($user) {
            $quests = Quest::with('users')->enabled();
            $quests = Quest::updateQuestStatusForUser(Auth::user(), $quests);
        }

        return view('quests', compact('quests'));
    }

    public function end(Request $request, $quest_name)
    {
        $questModel = Quest::where('name', $quest_name)->whereDoesntHave('users', function($query){
            $query->where('users.id', Auth::id());
        })->first();
        if(!$questModel)
            throw new ModelNotFoundException();

        $quest = QuestFactory::make($questModel->name);
        return $quest->end($request, $questModel);
    }
}
