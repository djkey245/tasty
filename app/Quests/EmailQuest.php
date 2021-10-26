<?php

namespace App\Quests;

use App\Models\Quest;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Sendpulse\RestApi\ApiClient;

class EmailQuest implements QuestInterface
{

    public function check(Request $request): bool
    {
        return true;
    }

    public function view(Request $request)
    {
        return '';
    }

    public function end(Request $request, Quest $quest) : Response
    {
        $request->validate([
            'email' => 'string|required'
        ]);
        $user = Auth::user();

        $sendPulseApi = app()->make(ApiClient::class);
        $quest->users()->attach($user);
        $user->addSumToBalance($quest->reward);
        $sendPulseApi->addEmails(config('sendpulse.main_book_id'), [$request->email]);

        return response([
            'modified_balance' => $user->modified_balance
        ]);
    }
}
