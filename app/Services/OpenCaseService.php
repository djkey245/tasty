<?php

namespace App\Services;


use App\Models\ChanceRange;
use Illuminate\Support\Facades\Auth;

class OpenCaseService
{


    public function generate($case, bool $itsVip = null)
    {
        $itsVip = is_null($itsVip)?Auth::check() && Auth::user()->vip === 1 : $itsVip;
        $range = $itsVip ? ChanceRange::find(3) : ChanceRange::find(2);
        $chances = $range->chances;

        $case_price = $case->price > 0 ? $case->price : 60;

        $max_drop_price = $chances->max('percent_to') * $case_price / 100;
        $drop = $itsVip
            ? $case->items()->where('price', '>', '0')->get()
            : $case->items()
                ->where([
                    ['active', '=', '1'],
                    ['price', '>', '0'],
                    ['price', '<=', $max_drop_price]
                ])->get();


        if ($case->type == 3) {
            $drop = $case->items()
                ->where([
                    ['active', '=', '1'],
                    ['price', '>', '0']
                ])
                ->get();
        }


        $test = [];

        $grouped = $drop->groupBy(function ($item, $key) use ($chances, $case, $case_price, $test) {
            foreach ($chances as $chance_key => $chance) {
                $min_limit = $chance->percent_from * $case_price / 100;
                $max_limit = $chance->percent_to * $case_price / 100;
                $test[] = ['min' => $min_limit, 'max' => $max_limit];

                if ($item->price >= $min_limit && $item->price <= $max_limit) {
                    return $chance_key;
                }
            }
        });

        unset($grouped['']);


        $drop_collection = collect();
        foreach ($grouped as $key => $group) {
            for ($i = 1; $i <= ($chances[$key]['chance'] * 100); $i++) {
                $drop_collection->push($group->random());
            }
        }
//
        $shuffled = $drop_collection->shuffle();
        return $shuffled->random();
    }


}
