<?php


namespace Fypex\QiwiPay\Models;


class Amount
{

    private $amount;
    private $currency;


    public function __construct(float $amount, string $currency)
    {

        $this->amount = number_format((float)$amount, 2, '.', '');
        $this->currency = $currency;

    }

    /**
     * @return float
     */
    public function getAmount(): float
    {
        return $this->amount;
    }

    /**
     * @return string
     */
    public function getCurrency(): string
    {
        return $this->currency;
    }

}
