<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class GiveAway extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['name'];

    protected $dates = ['end'];

}
