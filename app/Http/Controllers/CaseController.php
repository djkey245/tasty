<?php

namespace App\Http\Controllers;

use App\Events\LotCaseOpen;
use App\Helpers\ConvertHelper;
use App\Models\ChanceRange;
use App\Models\Lotcase;
use App\Models\LotcaseOpened;
use App\Models\LotcasesCategory;
use App\Models\Payment;
use App\Models\Score;
use App\Models\UserItem;
use App\Services\OpenCaseService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CaseController extends Controller
{


    public function show($slug)
    {
        $case = Lotcase::withTranslations()->whereSlug($slug)->first();
        if (empty($case) || $case->activeItems->count() <= 0) {
            return redirect('/');
        }
        $case = $case->translate();

        $items = $case->items->sortBy("title")->sortByDesc("rarity_sort");
        $feed = [];

        for ($i = 0; $i < 180; $i++) {
            $feed[] = $items->random();
        }


        $user = Auth::user();
        $smiles = json_decode(setting('site.smiles'));
        $randomSmile = $smiles ? $smiles[rand(0, count($smiles) - 1)] : "";

        $itsFirstCase = $case->type !== Lotcase::$defaultCaseType;

        $title = $case->seo_title;

        $description = $case->seo_description;

        $recommendCategory = LotcasesCategory::getRecommendedCategory();

        return view(
            'cases',
            compact(
                'case',
                'items',
                'user',
                'feed',
                'randomSmile',
                'itsFirstCase',
                'title',
                'description',
                'recommendCategory',
            )
        );
    }

    public function openCase(Request $request, Lotcase $case)
    {
        $fastOpen = $request->post('fastOpen') ?? 0;
        $user = Auth::user();
        if (!$user) {
            return $this->openCaseNA($case, $request);
        }

        return response()
            ->json($case->openCase($user, $fastOpen));

    }


    public function openCaseNA(Lotcase $case, $request)
    {
        $fastOpen = 0;
        if ($request->has('fastOpen')) {
            $fastOpen = $request->post('fastOpen');
        }


        DB::beginTransaction();
        try {
            $range = ChanceRange::find(3);
            $chances = $range->chances;
            $items = $case->activeItems()->where('price', '>', '0')->get();
            $case_price = $case->price;
            $grouped = $items->groupBy(function ($item, $key) use ($chances, $case, $case_price) {
                foreach ($chances as $chance_key => $chance) {
                    $min_limit = $chance->percent_from * $case->price / 100;
                    $max_limit = $chance->percent_to * $case->price / 100;

                    if ($case->discount_price !== null && $case->discount_price !== '' && $case->discount_price !== 0) {
                        $min_limit = $chance->percent_from * $case->discount_price / 100;
                        $max_limit = $chance->percent_to * $case->discount_price / 100;
                    }

                    $chance_id = $chance_key;
                    if ($item->price >= $min_limit && $item->price <= $max_limit) {
                        return $chance_id;
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
            $shuffled = $drop_collection->shuffle();
            $drop = $shuffled->random();
            $drop->color = $drop->color;
            $drop->rarity_class = $drop->rarity_class;
            event(new LotCaseOpen($drop, $fastOpen));

            DB::commit();
            return ["success" => $drop, "price" => $case->modified_price];
        } catch (\Exception $exception) {
            DB::rollBack();
            return response()->json(['error' => trans('blocks/http/error.400')], 400);
        }
    }


    public function firstCaseGetItem(Request $request, $col)
    {
        $user = Auth::user();
        $sum_payment = Payment::where('user_id', $user->id)->paidStatus()->whereIn('method', ['gamemoney', 'skinpay', 'unitpay'])->sum('sum');
        $user_item = UserItem::find($request->post('item'));
        if ($user_item->user_id !== $user->id) return ['error' => trans('http/case.bad_user')];
        $drop = $user_item->item()->first();
        if ($col == 1) {
            if ($sum_payment >= 1.3) {
                if ($user_item->status == 'fcase') {
                    $user_item->update(['status' => 'wait']);
                    $user->update(['balance' => floor($user->balance + 0.25)]);
                    return ['success' => $drop, 'balance' => $user->modified_balance];
                }
            }
            $sum_to_pay = 1.3 - $sum_payment;

        } else if ($col == 2) {
            if ($sum_payment >= 3.95) {
                if ($user_item->status == 'fcase') {
                    $user_item->update(['status' => 'wait']);
                    $user->update(['balance' => floor($user->balance + 0.25)]);

                    return ['success' => $drop, 'balance' => $user->modified_balance];
                }
            }
            $sum_to_pay = (3.95 - $sum_payment);


        } else if ($col == 3) {
            if ($sum_payment >= 13) {
                if ($user_item->status == 'fcase') {
                    $user_item->update(['status' => 'wait']);
                    $user->update(['balance' => floor($user->balance + 0.25)]);
                    /*                        $item = $this->generateKey(LotCase::find(9924));
                                            $user->drops()->save(new UserDrop(['class_id' => $item->class_id,
                                                'lotcase_id' => 9924,
                                                'instanceid' => $item->instanceid,
                                                'status' => 'wait']));
                                            $lotcaseOpened = new LotCaseOpened([
                                                'lotcase_id' => 9924,
                                                'class_id' => $item->class_id,
                                                'instanceid' => $item->instanceid,
                                                'drop_price' => $item->price,
                                                'sum' => 0,
                                            ]);*/

                    return ['success' => $drop, 'balance' => $user->modified_balance];
                }
            }
            $sum_to_pay = (13 - $sum_payment);
        } else {
            $sum_to_pay = 1.3 - $sum_payment;

        }
        return [
            'warning' => $drop,
            'balance' => $user->modified_balance,
            'info' => trans(
                'http/case.balance_require',
                ['sum' => ConvertHelper::convertValue($sum_to_pay - $sum_payment),
                    'currency_sign' => trans('project_defs.currency_sign')
                ]
            )
        ];
    }


}
