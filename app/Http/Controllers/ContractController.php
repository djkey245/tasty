<?php

namespace App\Http\Controllers;

use App\Events\StatCountUpdate;
use App\Models\Item;
use App\Models\UserItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContractController extends Controller
{
    public function show()
    {

        $user = Auth::user();

        $items = $user ? $user
            ->items()
            ->where('status', 'wait')
            ->with(['item' => function ($query) {
                $query->withTranslations();
            }])
            ->get() : [];

        $title = trans('titles.contract');

        return view('contract', compact('user', 'items', 'title'));

    }

    public function make(Request $request)
    {
        $items = $request->post('items');
        $user_items = array_values(array_filter($items));

        if (count($user_items) == 0 || count($user_items) > 10) {
            return ["error" => trans('http/contract.invalid_number_of_items')];
        }
        $drop_summ = 0;
        foreach ($user_items as $drop) {
            $user_drop = UserItem::find($drop);
            $drop = $user_drop->item()->first();
            if ($user_drop->status != "wait") {
                return ["error" => trans('http/contract.invalid_item_status')];
            }
            $drop_summ += $drop->price;
        }


        $rand1 = 0.3;
        $rand2 = 1.6;
        $rand_int = random_int(1, 1000);
        if ($rand_int > 950) {
            $rand1 = 1.3;
        }
        if ($rand_int < 300) {
            $rand2 = 0.5;
        }
        if ($rand_int > 300 || $rand_int < 950) {
            $rand1 = 0.5;
            $rand2 = 1.1;
        }

        $drops = Item::where([["price", ">=", ($drop_summ * $rand1)], ["price", "<=", ($drop_summ * $rand2)], ["active", "=", 1]])->get();
        if ($drops->count() < 1) {
            return ["error" => "Please choose another items."];
        }
        $drop = $drops->random(1)->first();
        if (!$drop) {
            $drop = Item::where([["price", ">=", ($drop_summ * 0.01)], ["price", "<=", ($drop_summ * 0.99)], ["active", "=", 1]])->get()->random(1)->first();
            if (!$drop) {
                return ["error" => trans('http/contract.invalid_item_status')];
            }
        }
        foreach ($user_items as $udrop) {
            UserItem::find($udrop)->update(['status' => 'pay']);
        }
        $user_drop = new UserItem(['item_id' => $drop->id,
            'lotcase_id' => $drop->lotcase_id,
            'price' => $drop->price,
            'is_contract' => 1,
            'status' => 'wait']);
        event(new StatCountUpdate('contract_count'));
        Auth::user()->items()->save($user_drop);
        $drop->user_drop_id = $user_drop->id;
        return response()->json(['item' => $drop, 'user_item' => $user_drop]);
    }

}
