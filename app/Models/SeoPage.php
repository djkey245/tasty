<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class SeoPage extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['title', 'description'];

    public function activeLotcases()
    {

        return $this->belongsToMany(Lotcase::class, 'seo_page_lotcases', 'seo_page_id', 'lotcase_id', 'id', 'id');
    }
}
