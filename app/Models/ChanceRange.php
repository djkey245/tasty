<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChanceRange extends Model
{
    use HasFactory;


    public function chances()
    {
        return $this->hasMany(Chance::class,'chances_range_id','id');
    }

}
