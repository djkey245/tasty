<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use TCG\Voyager\Traits\Translatable;

class LoginMessage extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['title', 'description'];

    public static $requiredType = 'required';
    public static $randomType = 'random';

    public static function authMessages(): Collection
    {
        $requiredMessages = self::requiredMessage();
        $randomElement = self::randomMessage();
        $result = $randomElement ? $requiredMessages->push($randomElement) : $requiredMessages;
        if(count($result)>=0) $result->translate();
        return $randomElement ? $requiredMessages->push($randomElement) : $requiredMessages;
    }

    public static function randomMessage(): ?LoginMessage
    {
        return self::where('type', self::$randomType)->inRandomOrder()->first();
    }

    public static function requiredMessage(): Collection
    {
        return self::where('type', self::$requiredType)->get();
    }
}
