<?php


namespace App\PaymentTypes;


use App\Models\LangPriceMultiplier;
use App\Models\Payment;
use Gamemoney\Exception\ResponseValidationException;
use Gamemoney\Gateway;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;
use Gamemoney\Request\RequestFactory;

class GamemoneyPaymentType extends PaymentType implements PaymentTypeInterface
{

    /**
     * @var Gateway
     */
    private $gateway;
    /**
     * @var RequestFactory
     */
    private $requestFactory;

    public function __construct(Gateway $gateway, RequestFactory $requestFactory)
    {
        $this->gateway = $gateway;
        $this->requestFactory = $requestFactory;
    }

    /**
     * @inheritDoc
     */
    public function create(Payment $payment): string
    {
        $cloudflareUserIp = request()->server('HTTP_CF_CONNECTING_IP');

        $amount = $this->calculateCreateFormAmount($payment->sum);

        $data = [
            'project' => config('services.gamemoney.project_id'),
            'user' => Auth::id(),
            'ip' => $cloudflareUserIp ?? request()->ip(),
            'project_invoice' => $payment->id,
            'amount' => $amount,
            'currency' => $this->defaultCurrency
        ];
        ksort($data);
        $signature = '';
        foreach ($data as $k => $item) {
            $signature .= $k . ':' . $item . ';';
        }
        Log::debug('Gamemoney:' . json_encode($data));
        $terminalRequest = $this->requestFactory->createTerminal($data);
        $response = $this->gateway->send($terminalRequest);
        //$payment->sign = $response['signature'];
        //$payment->save();
        if ($response['state'] === 'error')
            throw new ResponseValidationException();
        return $response['url'];
    }

    public function callback(Request $request)
    {
        $data = $request->all();

        Log::debug('GamemoneyCallback:' . json_encode($data));

        $payment = Payment::findWaiting($request->project_invoice);

        if ($payment->status) {
            return response(["success" => "true"], 200);
        }

        if ($data['status'] == "Paid") {
            $amount = $this->amountToServer(
                $payment->sum
            );
            $payment->user->addMoney($payment, $amount);
        }

        return response(["success" => "true"], 200);
    }
}
