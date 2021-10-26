<?php

namespace App\Models;

use App\Helpers\ConvertHelper;
use App\Traits\PriceModifierTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    use PriceModifierTrait;

    public static $waitStatus = 0;

    public static $paidStatus = 1;

    public static $minPayment = 2;

    protected $fillable = ['user_id', 'order_id', 'method', 'status', 'sum', 'sign', 'email', 'steam64'];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }

    public function getVisibleStatusAttribute()
    {
        return trans('models/payment/status.' . $this->status);
    }

    public function getShortCreatedAtAttribute()
    {
        return $this->created_at->format('d.m.Y');
    }


    public static function findWaiting($id): Payment
    {

        return self::where('status', self::$waitStatus)->where('id', $id)->firstOrFail();
    }

    public function scopePaidStatus($query)
    {
        return $query->where('status', self::$paidStatus);
    }

    public static function minLocalePayment()
    {
        return ConvertHelper::convertValue(self::$minPayment);
    }
}
