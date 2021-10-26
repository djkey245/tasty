<?php

namespace App\Models;

use App\Events\StatCountUpdate;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'item_id', 'lotcase_id', 'status', 'is_contract', 'price'
    ];

    protected $with = ['item', 'lotcase'];

    const STATUSES =
        [
            'wait',
            'pay',
            'process',
            'sent',
            'fcase',
        ];

    public function item()
    {

        return $this->hasOne(Item::class, 'id', 'item_id');
    }

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function lotcase()
    {
        return $this->hasOne(Lotcase::class, 'id', 'lotcase_id');
    }

    public static function fakeContractMake(Item $drop)
    {

        $drop = Item::query()->inRandomOrder()->first();
        $userItem = new UserItem(['item_id' => $drop->id,
            'lotcase_id' => $drop->lotcase_id,
            'price' => $drop->price,
            'is_contract' => 1,
            'user_id' => config('fake-open.user_id'),
            'status' => 'wait']);
        event(new StatCountUpdate('contract_count'));
        $userItem->save();
    }
}
