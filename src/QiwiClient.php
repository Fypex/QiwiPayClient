<?php

namespace Fypex\QiwiPay;

use Exception;
use Fypex\QiwiPay\Models\LinkToPaymentModel;
use Http\Client\Curl\Client as CurlClient;
use Http\Message\MessageFactory\DiactorosMessageFactory;
use Psr\Http\Message\ResponseInterface;
use Symfony\Component\HttpClient\HttpClient;

class QiwiClient{

    const HOST = 'https://api.qiwi.com';
    private $credentials;
    private $client;
    private $messageFactory;

    public static function init(QiwiCredentials $credentials, ?HttpClient $client = null): QiwiClient
    {
        return new static($credentials, $client);
    }

    public function __construct(QiwiCredentials $credentials, ?HttpClient $client = null)
    {

        $this->credentials = $credentials;
        $this->client = $client ?: new CurlClient(null,null,[
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_SSL_VERIFYPEER => false,
        ]);
        $this->messageFactory = new DiactorosMessageFactory();
    }

    public function receivingLinkToPayment(LinkToPaymentModel $model)
    {

        $siteId = $this->credentials->getSiteId();
        $bill_id = $model->getBillId();

        $body = [
            'amount' => [
                "currency" => $model->getAmount()->getCurrency(),
                "value" => $model->getAmount()->getAmount(),
            ],
            "billPaymentMethodsType" => $model->getBillPaymentMethodsType(),
            "comment" => $model->getComment(),
            "expirationDateTime" => $model->getExpirationDateTime().'+03:00',
        ];

        $request = $this->messageFactory->createRequest(
            'PUT',
            self::HOST.'/partner/payin/v1/sites/'.$siteId.'/bills/'.$bill_id,
            $this->getHeaders('application/json', true),
            json_encode($body)
        );

        $response = $this->client->sendRequest($request);

        return $this->handleResponse($response);

    }

    private function getHeaders(string $string, bool $authorized): array
    {

        $headers = [
            'Content-Type' => $string,
            'Accept' => $string,
        ];

        if ($authorized) {
            $headers['Authorization'] = 'Bearer '. $this->credentials->getToken();
        }
        return $headers;

    }

    protected function isJsonResponse(ResponseInterface $response): bool
    {
        $header = $response->getHeader('Content-Type')[0] ?? null;
        [$type,] = explode(';', $header);

        return $type === 'application/json';
    }

    protected function handleResponse(ResponseInterface $response)
    {
        if (!$this->isJsonResponse($response)) {
            throw new Exception('Response is not "application/json" type');
        }
        $data = json_decode((string)$response->getBody(), true);


        if ($response->getStatusCode() != 200 && $response->getStatusCode() != 201) {
            throw new Exception(json_encode($data), $response->getStatusCode());
        }

        return $data;
    }

}
