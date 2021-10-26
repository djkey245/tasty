<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class Question extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['question', 'answer'];
}
