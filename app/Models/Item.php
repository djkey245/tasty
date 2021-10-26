<?php

namespace App\Models;

use App\Traits\PriceModifierTrait;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use TCG\Voyager\Traits\Translatable;

class Item extends Model
{
    use HasFactory;
    use Translatable;
    use PriceModifierTrait;

    protected $translatable = ['title'];

    protected $appends = ['sound', 'modified_price'];


    public function getSoundAttribute()
    {
        if (strpos($this->title, '★') !== false) {
            return 'arcana';
        }
        switch ($this->rarity) {
            case "Basic quality":
                return 'common';
            case "Common":
                return 'common';
            case "Industrial quality":
                return 'uncommon';
            case "Military quality":
                return 'rare';
            case "Restricted":
                return 'mythical';
            case "Classified":
                return 'legendary';
            case "Covert":
                return 'immortal';
            case "High quality":
                return 'rare';
            case "Noteworthy type":
                return 'mythical';
            case "Exotic type":
                return 'legendary';
            case "Contraband":
                return 'immortal';
            case "Extraordinary type":
                return 'immortal';
            default:
                return 'common';
        }
    }

    public function getRaritySortAttribute()
    {
        if (strpos($this->title, '★') !== false) {
            return 10;
        }
        switch ($this->rarity) {
            case "Basic quality":
                return 0;
            case "Common":
                return 1;
            case "Industrial quality":
                return 2;
            case "Military quality":
                return 3;
            case "Restricted":
                return 4;
            case "Classified":
                return 5;
            case "Covert":
                return 7;
            case "High quality":
                return 3;
            case "Noteworthy type":
                return 4;
            case "Exotic type":
                return 5;
            case "Contraband":
                return 6;
            case "Extraordinary type":
                return 7;
            default:
                return 0;
        }
    }


    public function getTranslatedTitleAttribute()
    {
        return $this->getTranslatedAttribute('title');
    }

    public function setLocalImg(string $img)
    {
        $itemWithImg = self::where('img', $img)->whereNotNull('local_img')->first();
        if ($itemWithImg) {
            $this->local_img = $itemWithImg->local_img;
            $this->save();
            return;
        }
        $localImg = Image::make($this->downloadImage($img));

        $array = explode('.', $img);
        $extension = $array[count($array) - 1];

        $fileName = time() . '.' . $extension;
        $saveUrl = 'items/' . $this->class_id . '/' . $fileName;
        $localImg->resize(175, 125);
        $localImg->stream();
        Storage::disk('local')->put('public/' . $saveUrl, $localImg);
        $this->local_img = $saveUrl;
        $this->save();
    }

    public function getImgAttribute()
    {
        return $this->attributes['local_img'] ? '/storage/' . $this->attributes['local_img'] : $this->attributes['img']; //getter не работают изза translatable
    }

    public function getRemoteImgUrlAttribute(){
        return $this->attributes['img'];
    }

    public function downloadImage(string $url)
    {
        return file_get_contents($url);
    }


}
