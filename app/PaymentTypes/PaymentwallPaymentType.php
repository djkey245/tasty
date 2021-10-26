<?php


namespace App\PaymentTypes;


use App\Models\Payment;
use Illuminate\Http\Request;
use Paymentwall_Pingback;
use Paymentwall_Product;
use Paymentwall_Widget;

class PaymentwallPaymentType extends PaymentType implements PaymentTypeInterface
{

    public function create(Payment $payment): string
    {
        $payment->fresh();
        $amount = $this->calculateCreateFormAmount($payment->sum);
        $widget = new Paymentwall_Widget(
            $payment->user_id,
            'p1_1',
            [
                new Paymentwall_Product(
                    "payment$payment->id",
                    $amount,
                    $this->defaultCurrency,
                    'Top up account',
                    Paymentwall_Product::TYPE_FIXED
                )
            ]
        );
        return $widget->getUrl();
    }

    public function callback(Request $request)
    {
        $pingback = new Paymentwall_Pingback($request->all(), $request->ip());
        if ($pingback->validate()) {
            return response()->json(['result' => $pingback->getErrorSummary()], 400);
        }
        $goodsid = $pingback->getParameter('goodsid');
        if (!isset($goodsid)) return response()->json(['result' => 'goodsid not found']);
        $paymentArray = explode('payment', $goodsid);
        $paymentId = count($paymentArray) > 1 ? $paymentArray[1] : null;
        $payment = Payment::findWaiting($paymentId)
            ;

        if (config('services.paymentwall.disabled')) {
            $amount = $this->amountToServer($payment->sum);
            $payment->user->addMoney($payment,$amount);
        }
        $payment->status = 1;
        $payment->save();
        return "OK";
    }
}
