<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use TCG\Voyager\Traits\Translatable;

class LotcasesCategory extends Model
{
    use HasFactory;
    use Translatable;

    protected $translatable = ['title'];


    public function lotcases()
    {

        return $this->hasMany(Lotcase::class, 'category_id');
    }

    public function activeLotcases()
    {

        return $this->hasMany(Lotcase::class, 'category_id')->where('active', 1)->orderBy('position', 'asc');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }

    public static function getRecommendedCategory()
    {
        return self::where('id', setting('site.recommend_category_id'))
            ->active()
            ->with('activeLotcases', function($query) {
                $query->withTranslations();
            })
            ->first()
            ;
    }
}
