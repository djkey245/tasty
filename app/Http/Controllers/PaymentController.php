<?php

namespace App\Http\Controllers;

use App\Helpers\ConvertHelper;
use App\Models\LangPriceMultiplier;
use App\Models\Payment;
use App\Models\Promocode;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use App\Models\PaymentType;

class PaymentController extends Controller
{
    public function show()
    {
        $userPayments = Auth::user()->payments->sortByDesc('created_at');
        $sumBlocks = [5, 10, 20, 50, 100, 200];

        $multiplier = LangPriceMultiplier::getMultiplier(App::getLocale());

        foreach ($sumBlocks as &$sumBlock) {
            $sumBlock *= $multiplier;
        }

        $coinModifier = 20 / $multiplier;
        $coinModifier = $coinModifier > 1 ? intval($coinModifier) : 1;

        return view('payment', compact('userPayments', 'sumBlocks', 'coinModifier'));
    }

    public function promo(Request $request)
    {

        $promo = $request->has('promo') ? strtoupper($request->post('promo')) : '';
        if (empty($promo)) {
            return response()->json(["error" => trans('empty_promocode')]);
        }
        $promocode = Promocode::where('name', $promo)->first();
        $user = Auth::user();
        $promocode_user = $user->promocodes()->where('promocode', $promo)->get();
        if (empty($promocode)) {
            return response()->json(["error" => trans('wrong_promocode')]);
        }
        if ($promocode_user->count() > 0) {
            if ($promocode_user->first()->active) {
                return response()->json(["error" => trans('already_used_promocode'), "message" => trans('already_used_promocode')]);
            } else {
                return response()->json(["error" => trans('already_used_by_you_promocode'), "message" => trans('already_used_promocode')]);
            }
        }

        $result = $user->promocodes()->create([
            "promocode" => $promocode->name,
            "discount" => $promocode->discount,
            "promocode_id" => $promocode->id,
            "active" => $promocode->active,
        ]);
        return response()->json(['success' => trans('http/payment.success_promocode'), "message" => trans('http/payment.success_message_promocde', ['discount' => $promocode->discount])]);
    }


    public function generatePaymentForm($method, Request $request)
    {
        $request->validate([
            'sum' => 'numeric|required|min:0.5',
            'locale' => 'string'
        ]);

        $paymentType = PaymentType::findBySlug($method);
        if (!$paymentType) {
            return redirect('/');
        }

        if ($request->promo) {
            return $this->promo($request);
        }

        $paymentTypeObject = App::make($paymentType->class);

        $payment = new Payment();
        $payment->order_id = rand(1000000, 9999999);
        $payment->status = 0;
        $payment->user_id = Auth::user()->id;
        $payment->method = $method;
        $payment->sum = $request->get('sum');
        $payment->converted_sum = ConvertHelper::convertValue(
            $payment->sum,
            LangPriceMultiplier::getMultiplier(App::getLocale()),
            LangPriceMultiplier::getMultiplier(LangPriceMultiplier::$serverCurrency)
        );

        $payment->save();


        Log::debug('Method:' . $method);


        return response()->json(['href' => $paymentTypeObject->create($payment, $request)]);
    }

    public function notificationCallback($method, Request $request)
    {
        Log::debug('Gamemoney_notify:' . json_encode($method));
        Log::debug('Gamemoney_notify:' . json_encode($request->all()));

        $paymentType = PaymentType::findBySlug($method);
        if (!$paymentType) {
            return;
        }
        $paymentTypeObject = App::make($paymentType->class);

        return $paymentTypeObject->callback($request);
    }


    //Все остальное устарело. Нужно будет для последуещего переноса
    public function skinpay(Payment $payment, Request $request)
    {
        if (Auth::user()->provider == 'steam') {
            $payment->steam64 = Auth::user()->provider_uid;
        } else {
            $partner = explode('&token=', explode('?partner=', $payment->user->link_o)[1])[0];
            $payment->steam64 = '7656119' . (7960265728 + $partner);
        }
        $query = array(
            'orderid' => $payment->order_id,
            'key' => config('services.skinpay.public_id'),
            'userid' => $payment->steam64
        );
        $payment->sign = hash_hmac('sha1', $this->skinpay_sing($query), config('services.skinpay.private_id'));
        $payment->save();
        return response()->json("https://skinpay.com/deposit?orderid=" . $payment->order_id . "&sign=" . $payment->sign . "&key=" . config('services.skinpay.public_id') . "&userid=" . $payment->steam64);
    }


    public function gamemoney(Payment $payment, Request $request)
    {

        $sum = $request->get('sum');
        $data['amount'] = $sum ? $sum : 25;
        $payment->sum = isset($data['amount']) ? $data['amount'] : 0;
        $payment->save();
        $data['project'] = config('');
        $data['user'] = Auth::id();
        $data['project_invoice'] = $payment->id;
        ksort($data);
        $signature = '';
        foreach ($data as $k => $item) {
            $signature .= $k . ':' . $item . ';';
        }
        $data['signature'] = hash_hmac('sha256', $signature, config('sevices.gamemoney.hmac_secret'));
        $payment->sign = $data['signature'];
        $payment->save();
        Log::debug('Gamemoney:' . json_encode($data));

        return response()->json($data);
    }

    public function gamemoney_callback(Request $request)
    {
        $data = $request->all();

        Log::debug('GamemoneyCallback:' . json_encode($data));

        $payment = Payment::findWaiting($data['project_invoice']);

        if ($payment->status) {
            return response(["success" => "true"], 200);
        }

        if ($data['status'] == "Paid") {
            $this->addMoney($payment, $data['amount']);
        }

        return response(["success" => "true"], 200);
    }

    public function skinpay_callback(Request $request)
    {
        $alloved_ip = ['178.32.185.196', '178.32.185.197'];
        if (!in_array(request()->server('HTTP_CF_CONNECTING_IP'), $alloved_ip) && !in_array(request()->ip(), $alloved_ip)) {
            exit('Error: IP security');
        }
        $payment = Payment::where('order_id', '=', $request->post('orderid'))->first();
        $out_summ = floor($request->post("amount") / 100);
        if ($request->post("status") === 'success') {
            $payment->update(["sum" => $out_summ]);
            $this->addMoney($payment, $out_summ);
            return response('OK', 200);
        }
    }


    private function addMoney(Payment $payment, $out_summ)
    {

    }


    private function skinpay_sing($q)
    {
        ksort($q);
        $paramsString = '';
        foreach ($q as $key => $value) {
            if ($key == 'sign') continue;
            $paramsString .= $key . ':' . $value . ';';
        }
        return $paramsString;
    }

}
