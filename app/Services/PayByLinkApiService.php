<?php


namespace App\Services;


use GuzzleHttp\Client;
use GuzzleHttp\RequestOptions;
use Psr\Http\Message\ResponseInterface;
use Barryvdh\Debugbar\Facade as Debugbar;

class PayByLinkApiService
{
    /**
     * @var string
     */
    private $secretKey;
    /**
     * @var mixed|string
     */
    private $version;
    /**
     * @var Client
     */
    private $apiClient;
    /**
     * @var int
     */
    private $shopId;

    public function __construct(string $secretKey, int $shopId, string $version = 'v1')
    {
        $this->secretKey = $secretKey;
        $this->shopId = $shopId;
        $this->version = $version;
        $this->apiClient = new Client([
            'base_uri' => $this->getBaseUri(),
        ]);
    }

    private function getBaseUri(): string
    {
        return "https://secure.paybylink.pl/api/$this->version/";
    }


    public function transactionGenerate(array $parameters): ResponseInterface
    {
        $parameters = $this->setDefaultDataForTransactionGenerate($parameters);
        return $this->apiClient->post('transfer/generate', [RequestOptions::JSON => $parameters]);
    }

    private function setDefaultDataForTransactionGenerate(array $parameters): array
    {
        $defaultArray = [
            'shopId' => $this->shopId,
        ];
        $parameters = array_merge($defaultArray, $parameters);
        $parameters['signature'] = $this->generateSign(
            $parameters
        );

        return $parameters;
    }

    public function generateSign(array $parameters): string
    {
        if(isset($parameters['price']))$parameters['price'] = number_format($parameters['price'], 2);
        $stringToHash = $this->secretKey . '|' . implode('|', $parameters);
        return hash('sha256', $stringToHash);

    }

    public function checkSign(array $parameters, string $sign): bool
    {
        return $this->generateSign($parameters) === $sign;
    }
}
