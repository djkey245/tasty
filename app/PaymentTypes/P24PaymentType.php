<?php


namespace App\PaymentTypes;


use App\Models\LangPriceMultiplier;
use App\Models\Payment;
use App\Services\P24ApiService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class P24PaymentType extends PaymentType implements PaymentTypeInterface
{

    /**
     * @var P24ApiService
     */
    private $apiService;

    public function __construct(P24ApiService $apiService)
    {
        $this->apiService = $apiService;
    }

    /**
     * @inheritDoc
     */
    public function create(Payment $payment): string
    {
        $amount = intval($payment->sum * 100);

        $amount = $this->calculateCreateFormAmount($amount);

        $result = $this->apiService->transactionRegister([
            'amount' => $amount,
            'currency' => $this->defaultCurrency,
            'sessionId' => "$payment->id",
            'language' => App::getLocale(),
            'urlStatus' => route('paymentCallback', ['method' => 'p24'])
        ]);

        if ($result->getStatusCode() !== 200) {
            throw new \Exception();
        }
        $body = json_decode($result->getBody()->getContents());

        return $this->apiService->getUrlByToken($body->data->token);
    }

    public function callback(Request $request)
    {

        if (!$this->checkOnValid($request)) return;

        $payment = Payment::findWaiting($request->sessionId);
        if ($payment) {
            $amount = $request->amount;
            $this->apiService->transitionVerify([
                'sessionId' => $payment->id,
                'amount' => $amount,
                'currency' => $request->currency,
                'orderId' => $request->orderId

            ]);
            if (config('services.p24.productionMode')) {
                $amount = $this->amountToServer(
                    $amount,
                    $request->currency
                );
                $payment->user->addMoney($amount / 100);
            }
            $payment->status = 1;
        }
    }

    private function checkOnValid(Request $request)
    {
        $request->validate([
            'merchantId' => 'integer',
            'posId' => 'integer',
            'amount' => 'integer',
            'originAmount' => 'integer',
            "orderId" => "integer",
            "methodId" => "integer"
        ]);
        $arrayToHash = $request->only([
            'merchantId',
            'posId',
            'sessionId',
            'amount',
            'originAmount',
            'currency',
            'orderId',
            'methodId',
            'statement'
        ]);
        return hash('sha384', $this->hashArray($arrayToHash)) === $request->sign;
    }

    private function hashArray(array $array): string
    {
        return hash('sha384', json_encode($array));
    }
}
