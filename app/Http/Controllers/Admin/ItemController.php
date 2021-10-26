<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Item;
use App\Models\Lotcase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class ItemController extends Controller
{
    public function addNewItem(Request $request, Lotcase $case)
    {
        //
        //   https://market.csgo.com/en/item/937285535-188530170-StatTrak%E2%84%A2%20Desert%20Eagle%20%7C%20Bronze%20Deco%20(Field-Tested)/

        if ($request->has('url')) {
            $link = $request->input('url');

            $l_s = explode('-', explode('/', $link)[4]);
            if(empty($l_s[1])){
                $l_s = explode('-', explode('/', $link)[5]);
                $classid = $l_s[0];
                $instanceid = $l_s[1];
            }
            else{
                $classid = $l_s[0];
                $instanceid = $l_s[1];

            }
            sleep(1);
            $get_t = "https://" . config('urls.dropmarket.url') . "/api/ItemInfo/" . $classid . "_" . $instanceid . "/en/?key=" . config('urls.dropmarket.key');
            $item_info = json_decode(file_get_contents($get_t), true);
//            dd($item_info);
            $title_m = isset($item_info['market_hash_name']) ? $item_info['market_hash_name'] : $item_info['name'];

            $img = "https://cdn.csgo.com/item/" . str_replace("'", "%27", str_replace(" ", "+", $title_m)) . "/300.png";
//        dd($item_info);
            $color = null;
            if (isset($item_info['tags'][4])) {
                if (isset($item_info['tags'][4]['color'])) {
                    $color = $item_info['tags'][4]['color'];
                }
            }

            if (!$color) {
                if (isset($item_info['description'][4])) {
                    if (isset($item_info['description'][4]['color'])) {
                        $color = $item_info['description'][4]['color'];
                    }
                }
                if (!$color) {
                    $color = '555';
                }
            }
            $item = new Item();
            $item->class_id = $classid;
            $item->instanceid = $instanceid;
            $item->hash = $item_info['hash'];
            $item->title = $item_info['name'];
            $item->price = ($item_info['min_price'] / 100 / 76);
            $item->lotcase_id = $case->id;
            $item->img = $img;
            $item->link = $link;
            $item->color = $this->chooseColor($color);
            $item->rarity = $item_info['rarity'];
            $item->exist = 1;
            $item->active = 1;
            $item->save();

            $item->setLocalImg($img);

            return response()->json($item, 202);

        } else {
            return response('', '400');
        }
    }

    public function updateItem(Lotcase $case, Item $item)
    {

        if (!empty($item) && !empty($item->link)) {
            $link = $item->link;

            $l_s = explode('-', explode('/', $link)[4]);
            if(empty($l_s[1])){
                $l_s = explode('-', explode('/', $link)[5]);
                $classid = $l_s[0];
                $instanceid = $l_s[1];
            }
            else{
                $classid = $l_s[0];
                $instanceid = $l_s[1];

            }
            sleep(1);
            $get_t = "https://" . config('urls.dropmarket.url') . "/api/ItemInfo/" . $classid . "_" . $instanceid . "/en/?key=" . config('urls.dropmarket.key');
            $item_info = json_decode(file_get_contents($get_t), true);
//            dump($item_info);
            $title_m = isset($item_info['market_hash_name']) ? $item_info['market_hash_name'] : $item_info['name'];

            $img = "https://cdn.csgo.com/item/" . str_replace("'", "%27", str_replace(" ", "+", $title_m)) . "/300.png";
//        dd($item_info);
            $color = null;
            if (isset($item_info['tags'][4])) {
                if (isset($item_info['tags'][4]['color'])) {
                    $color = $item_info['tags'][4]['color'];
                }
            }

            if (!$color) {
                if (isset($item_info['description'][4])) {
                    if (isset($item_info['description'][4]['color'])) {
                        $color = $item_info['description'][4]['color'];
                    }
                }
                if (!$color) {
                    $color = '555';
                }
            }

            $item->class_id = $classid;
            $item->instanceid = $instanceid;
            $item->hash = $item_info['hash'];
            $item->title = $item_info['name'];
            $item->price = ($item_info['min_price'] / 100 / 76);
            $item->lotcase_id = $case->id;
            $item->img = $img;
            $item->link = $link;
            $item->color = $this->chooseColor($color);
            $item->rarity = $item_info['rarity'];
            $item->exist = 1;


            $price = ($case->price) ;
            $drop_price = ($item->price);
            $item->active = 1;

            if(in_array($case->type, ['default','hearts'])){
                if ($drop_price > ($price * ($case->coef_price) )) {
                    $item->active = 0;
                    $item->save();
                }
            }
            if($item->price <= 0){
                $item->active = 0;
                $item->save();
            }

            $item->save();

            $item->setLocalImg($img);

            return response()->json($item, 202);

        } else {
            return response('', '400');
        }
    }

    public function changeStatus(Request $request, Item $item)
    {
        if (!empty($item) && $request->has('status')) {

            $item->active = $request->input('status') == "true" ? 1 : 0;
            $item->save();

            return response()->json('', 202);

        } else {
            return response('', '400');
        }
    }

    public function delete(Item $item)
    {

        if (!empty($item)) {
//            $item->delete();
            $item->lotcase_id = 0;
            $item->save();

            return response()->json('', 202);

        } else {
            return response('', '400');
        }
    }

    public function updateAll(Lotcase $case){
        $items = $case->items;
        foreach ($items as $item) {
            try {

                $this->updateItem($case, $item);

                sleep(1);
            }catch (\Exception $exception){
                Log::error($exception);
                continue;
            }

        }
        if ($case->type == 'free') {
            return;
        }


    }

    private function chooseColor($hex){
        $table = [];
        $table['000'] = 'orange';
        $table['000000'] = 'orange';
        $table['555'] = 'white';
        $table['5e98d9'] = 'lightblue';
        $table['b0c3d9'] = 'lightblue';
        $table['4b69ff'] = 'darkblue';
        $table['8847ff'] = 'violet';
        $table['d32ce6'] = 'rose';
        $table['eb4b4b'] = 'red';
        $table['e4ae39'] = 'yellow';
        return !empty($table[$hex])? $table[$hex]: $hex;
    }
}
