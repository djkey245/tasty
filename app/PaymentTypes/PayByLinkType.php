<?php


namespace App\PaymentTypes;


use App\Models\LangPriceMultiplier;
use App\Models\Payment;
use App\Services\PayByLinkApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;

class PayByLinkType extends PaymentType implements PaymentTypeInterface
{

    /**
     * @var PayByLinkApiService
     */
    private $payByLinkApi;

    private $paymentSlug = 'paybylink';

    protected $defaultCurrency = 'PLN';

    public function __construct(PayByLinkApiService $payByLinkApi)
    {
        $this->payByLinkApi = $payByLinkApi;
    }

    public function create(Payment $payment): string
    {
        $amount = $this->calculateCreateFormAmount($payment->sum);

        $result = $this->payByLinkApi->transactionGenerate([
            'price' => $amount,
            'control' => "$payment->id",
            'notifyUrl' => route('paymentCallback', ['method' => $this->paymentSlug]),
            'returnUrlSuccess' => URL::to('/')
        ]);
        $bodyResult = json_decode($result->getBody()->getContents());
        if (isset($bodyResult->transactionId)) $payment->sign = $bodyResult->transactionId;
        return $bodyResult->url;
    }

    public function callback(Request $request)
    {
        if ($this->payByLinkApi->checkSign($request->all(), $request->signature)) {
            Log::error('error in sign check');
            return response('error in sign check', 500);
        }
        $payment = Payment::findWaiting($request->control);
        $amount = $this->amountToServer(
            $request->amountPaid
        );
        $payment->user
            ->addMoney($payment, $amount);
        return response('OK');
    }
}
