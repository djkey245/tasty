<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromocodesUser extends Model
{
    use HasFactory;

    protected $fillable = ['promocode', 'promocode_id', 'discount', 'user_id', 'active'];
}
