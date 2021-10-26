<?php

namespace App\Models;

use App\Traits\PriceModifierTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use TCG\Voyager\Traits\Translatable;

class Quest extends Model
{
    use HasFactory;
    use PriceModifierTrait;
    use Translatable;

    public $translatable = ['title', 'description'];

    private $icons = [
        'email' => '/img/icons/email01.svg'
    ];

    public function scopeEnabled()
    {
        return self::query()->where('enabled', 1)->get();
    }

    public static function updateQuestStatusForUser(User $user, Collection $quests)
    {
        return $quests->map(function ($quest) use ($user) {
            $quest->alreadyDone = $quest->users->contains($user);
            return $quest;
        });
    }

    public function getModifiedRewardAttribute()
    {
        return $this->getMultiplied('reward');
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function hasUser(User $user)
    {
        return $this->users->contains($user);
    }

    public function getIconUrlAttribute()
    {
        return $this->icons[$this->icon] ?? $this->icons['email'];
    }

    public function getTranslatedTitleAttribute()
    {
        return $this->getTranslatedAttribute('title');
    }
}
