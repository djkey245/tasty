<?php

namespace App\Quests;

use Illuminate\Http\Request;

interface QuestInterface
{
    public function check(Request $request): bool;

    public function view(Request $request);
}
