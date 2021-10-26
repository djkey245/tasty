<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

class Role extends Model
{
    public static $botRoleName = 'bot';

    use HasFactory;

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function getBotUsers(): Collection
    {
        $role = self::where('name', self::$botRoleName)
            ->first();
        return $role? $role->users: collect();
    }
}
