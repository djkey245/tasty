<?php

namespace App\Quests;

use Illuminate\Support\Facades\App;

class QuestFactory
{
    private static $questNames = [
        'email-quest' => EmailQuest::class
    ];

    public static function make(string $name): ?QuestInterface
    {
        if (isset(self::$questNames[$name])) return App::make(self::$questNames[$name]);
        return null;
    }
}
