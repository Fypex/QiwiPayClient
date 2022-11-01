<?php


namespace Fypex\QiwiPay;


class QiwiCredentials
{

    private $publicKey;
    private $token;
    private $siteId;
    private $serverKey;

    public static function init(
        string $publicKey,
        string $token,
        string $siteId,
        string $serverKey
    ): QiwiCredentials
    {
        return new static($publicKey, $token, $siteId, $serverKey);
    }

    public function __construct(
        string $publicKey,
        string $token,
        string $siteId,
        string $serverKey
    )
    {

        $this->publicKey = $publicKey;
        $this->token = $token;
        $this->siteId = $siteId;
        $this->serverKey = $serverKey;

    }

    /**
     * @return string
     */
    public function getPublicKey(): string
    {
        return $this->publicKey;
    }

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @return string
     */
    public function getSiteId(): string
    {
        return $this->siteId;
    }

    /**
     * @return string
     */
    public function getServerKey(): string
    {
        return $this->serverKey;
    }

}
