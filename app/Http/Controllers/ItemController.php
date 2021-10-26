<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\UserItem;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use JsonSchema\Uri\Retrievers\Curl;

class ItemController extends Controller
{

    public function saleItem(Request $request)
    {

        $user = Auth::user();
        $user_item = UserItem::find($request->post('user_item'));
        if ($user_item->user_id == $user->id) {
            $item = Item::find($user_item->item_id);
            $price = $item->price <= 0 ? 0 : round($item->price, 2);
            if ($user_item->status == 'wait') {
                $user_item->update(['status' => 'pay']);
                $user->update(['balance' => round($user->balance + $price, 2)]);
//                \balanceStat($user, 'saleItem', 'Drop', $item->id); //TODO: balanceStat saleItem
                return ['success' => $item, 'balance' => $user->modified_balance];
            }
            return ['warning' => $item, 'balance' => $user->modified_balance, 'info' => trans('http/item.already_sold')];
        }
        return ['error' => "Bad User!"];

    }


    public function takeItem(Request $request)
    {
        $user = Auth::user();

        if ($user->link_o == null && $user->link_o == '') {
            return ['error' => trans('http/controller.need_steam64')];
        }

        $user_item_id = $request->post('user_item');
        $userItem = $user->items()->find($user_item_id);
        if (is_null($userItem)) {
            return ['error' => trans('http/controller.item_not_foun')];
        }

        if ($userItem->status === 'process') {
            return ['error' => trans('http/controller.error_item_in_process')];
        }

        if ($userItem->status !== 'wait') {
            return ['error' => trans('http/controller.error_cannot_withdraw')];
        }

        $userItem->update(['status' => 'process']);
        // link_o example: https://steamcommunity.com/tradeoffer/new/?partner=492951296&token=tk4vayRo
        $tokenAndPartner = explode('&', explode('?', $user->link_o)[1]);
        $partner = explode('=', $tokenAndPartner[0])[1];
        $token = explode('=', $tokenAndPartner[1])[1];
        $drop = $userItem->item()->first();
        $curl = new Client();
        try {
            $curl->request('GET', config('urls.market_bot.url'), [
                'query' => [
                    'instanceid' => $drop->instanceid,
                    'classid' => $drop->class_id,
                    // 'price' => $drop->price * 100, если не нужна проверка цены, то не нужно передавать параметр price
                    'token' => $token,
                    'partner' => $partner,
                    'listener' => config('urls.market_bot.listener'),
                    'customid' => $userItem->id

                ]
            ]);
            $userItem->update(['status' => 'sent']);
            return ['success' => $drop];

        } catch (RequestException $exception) {
            $userItem->update(['status' => 'wait']);
            $response = $exception->getResponse();
//            if (isset($response->showMarketError) && $response->showMarketError) {
            return ['error' => $exception];
//            }
            return ['error' => trans('http/controller.error_buying_item')];

        }
        /*        $curl->get(env('MARKET_BOT_URL'), [
                    'instanceid' => $drop->instanceid,
                    'classid' => $drop->class_id,
                    // 'price' => $drop->price * 100, если не нужна проверка цены, то не нужно передавать параметр price
                    'token' => $token,
                    'partner' => $partner,
                    'listener' => env('MARKET_BOT_LISTENER'),
                    'customid' => $userItem->id
                ]);*/

//        sendNewRequestForTakeItem($drop, $userDrop, $user->id);

        /*        if ($curl->error) {
                } else {
                }*/
    }

    public function updateItemStatus(Request $request)
    {
        Log::alert($request->status);
        Log::alert($request->id);
        Log::alert($request->customid);
        $userItem = UserItem::findOrFail($request->customid);
        $hash = hash('sha256', $request->customid . config('urls.market_bot.listener'));
        if ($hash !== $request->id) return response()->json(['message' => 'wrong data'], 400);
        if ($request->status === '400'){
            $userItem->status = 'wait';
            $userItem->save();
        }
        return response()->json(['result'=>'ok']);
    }

}
