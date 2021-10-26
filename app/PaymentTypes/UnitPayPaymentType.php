<?php


namespace App\PaymentTypes;


use App\Models\LangPriceMultiplier;
use App\Models\Payment;
use CashItem;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\App;
use Illuminate\Http\Request;
use UnitPay;

class UnitPayPaymentType extends PaymentType implements PaymentTypeInterface
{

    /**
     * @var UnitPay
     */
    private $unitPay;

    public function __construct(UnitPay $unitPay)
    {
        $this->unitPay = $unitPay;
    }

    public function create(Payment $payment): string
    {
        $publicId = config('unitpay.public-key');

        $itemName = 'tasty-case';

        $orderId = $payment->id;
        $orderSum = $payment->sum;
        $orderDesc = 'Payment for "' . $itemName . '"';
        $locale = App::getLocale();
        $orderCurrency = LangPriceMultiplier::getCurrencyByLang($locale);
        $this->unitPay
            ->setCashItems(array(
                new CashItem($itemName, 1, $orderSum)
            ));

        $redirectUrl = $this->unitPay->form(
            $publicId,
            $orderSum,
            $orderId,
            $orderDesc,
            $orderCurrency,
            $locale
        );
        $payment->sign = $this->unitPay->getSignature([$orderId, $orderCurrency, $orderDesc, $orderSum]);
        $payment->save();
        $redirectUrl .= '&hideMenu=false';
        return $redirectUrl;
    }

    public function callback(Request $request)
    {

        $array = $request->params;
        $array['method'] = $request->get('method');
        try {
            $payment = Payment::findWaiting($array['account']);
        } catch (ModelNotFoundException $e) {
            $payment = null;
        }

        if ($array['method'] == "pay" && $payment) {
            try {
                $out_summ = $this->amountToServer($array['orderSum'], $array['orderCurrency']);
                $payment->data = json_encode($array);
                $payment->save();

                $payment->user->addMoney($payment, $out_summ);
                return response()->json(['result' => ['message' => 'Запрос успешно обработан']]);
            } catch (\Exception $exception) {
                return response()->json(['result' => ['message' => 'Error']]);
            }

        }
        if ($array['method'] == "check" && $payment) {
            $payment->data = json_encode($array);
            $payment->save();

            return response()->json(['result' => 'Check method']);

        }
        if ($array['method'] == "error") {

            return response()->json(['result' => 'Error'], 400);

        }
        return response()->json(['result' => 'Don`t pay, if method pay. Success, if other method']);
    }
}
