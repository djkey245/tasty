<?php

namespace App\Models;

use App\Events\StatCountUpdate;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class LotcaseOpened extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 'item_id', 'lotcase_id', 'item_price', 'case_price'
    ];

    protected static function boot()
    {
        parent::boot();
        self::created(function () {
            event(new StatCountUpdate('opened_case_count'));
        });
    }

    public function item()
    {
        return $this->hasOne(Item::class, 'id', 'item_id');
    }

    public static function topDrop()
    {
        return Cache::remember('top-case-opens', 604800, function () {
            $openIds = self::query()
                ->where('created_at', '>', Carbon::now()->subDays(4)->format('Y-m-d'))
                ->orderByDesc('max_item_price')
                ->take(7)
                ->groupBy('user_id', 'item_id')
                ->with('item')
                ->select(DB::raw('MAX(id) as id'), DB::raw('MAX(item_price) as max_item_price'))
                ->pluck('id');
            return self::whereIn('id', $openIds)->orderByDesc('item_price')->get();
        });
    }
}
