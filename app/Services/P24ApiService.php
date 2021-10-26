<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;

class P24ApiService
{
    private $merchantId;
    private $apiClient;
    private $crc;
    private $isProduction;

    public function __construct(int $merchantId, string $password, string $crc, $isProduction = false)
    {
        $this->merchantId = $merchantId;
        $this->crc = $crc;
        $this->isProduction = $isProduction;
        $this->apiClient = new Client(['base_uri' => $this->getApiUrl($isProduction), 'auth' => [
            $merchantId, $password
        ]]);
    }

    private function getBaseUrl(bool $isProduction): string
    {
        return ($isProduction ? 'https://secure.przelewy24.pl' : 'https://sandbox.przelewy24.pl') . '/';
    }

    private function getApiUrl(bool $isProduction): string
    {
        return $this->getBaseUrl($isProduction) . 'api/v1/';
    }

    public function testAuth()
    {
        return $this->apiClient->get('testAccess');
    }

    public function transactionRegister(array $parameters, array $cartArray = [])
    {
        $parameters = $this->setDefaultDataForTransactionRegister($parameters);

        if (count($cartArray) > 0) $parameters['cart'] = $cartArray;
        return $this->apiClient->post('transaction/register', [RequestOptions::JSON => $parameters]);
    }

    private function setDefaultDataForTransactionRegister(array $parameters): array
    {
        $defaultArray = [
            'merchantId' => $this->merchantId,
            'posId' => $this->merchantId,
            'sessionId' => 'session',
            'amount' => 1,
            'currency' => 'pl',
            'description' => 'description',
            'email' => 'test@gmail.com',
            'country' => 'PL',
            'language' => 'pl',
            'urlReturn' => route('home'),
            'timeLimit' => 5,
            'waitForResult' => true,
        ];
        $parameters = array_merge($defaultArray, $parameters);
        $parameters['sign'] = $this->getRegisterSign(
            $parameters['sessionId'],
            $parameters['merchantId'],
            $parameters['amount'],
            $parameters['currency']
        );

        return $parameters;
    }

    private function getSign(array $array): string
    {

        $array['crc'] = $this->crc;
        return hash('sha384', json_encode($array));
    }

    private function getRegisterSign(string $sessionId, int $merchantId, int $amount, string $currency): string
    {
        $arrayToHash = [
            'sessionId' => $sessionId,
            'merchantId' => $merchantId,
            'amount' => $amount,
            'currency' => $currency
        ];
        return $this->getSign($arrayToHash);
    }

    private function getVerifySign(string $sessionId, int $orderId, int $amount, string $currency): string
    {
        $arrayToHash = [
            'sessionId' => $sessionId,
            'orderId' => $orderId,
            'amount' => $amount,
            'currency' => $currency
        ];
        return $this->getSign($arrayToHash);
    }


    public function transitionVerify(array $parameters)
    {
        $parameters = $this->setDefaultDataForTransactionVerify($parameters);
        return $this->apiClient->put('transaction/verify', [RequestOptions::JSON => $parameters]);
    }

    private function setDefaultDataForTransactionVerify(array $parameters): array
    {

        $defaultArray = [
            'merchantId' => $this->merchantId,
            'posId' => $this->merchantId,
            'sessionId' => 'session',
            'orderId' => '300147701',
            'amount' => 1,
            'currency' => 'PLN'
        ];
        $parameters = array_merge($defaultArray, $parameters);
        $parameters['sign'] = $this->getVerifySign(
            $parameters['sessionId'],
            $parameters['orderId'],
            $parameters['amount'],
            $parameters['currency']
        );
        return $parameters;
    }

    public function getUrlByToken($token): string
    {
        return $this->getBaseUrl($this->isProduction) . "/trnRequest/${token}";
    }
}
