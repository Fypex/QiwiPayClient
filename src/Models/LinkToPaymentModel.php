<?php


namespace Fypex\QiwiPay\Models;


class LinkToPaymentModel
{

    private $billId;
    private $amount;
    private $expirationDateTime;
    private $billPaymentMethodsType;
    private $comment;

    /**
     * @param mixed $comment
     */
    public function setComment($comment): void
    {
        $this->comment = $comment;
    }

    /**
     * @return mixed
     */
    public function getComment()
    {
        return $this->comment;
    }

    /**
     * @param mixed $billId
     */
    public function setBillId($billId): void
    {
        $this->billId = $billId;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount(Amount $amount): void
    {
        $this->amount = $amount;
    }

    /**
     * @param mixed $expirationDateTime
     */
    public function setExpirationDateTime($expirationDateTime): void
    {
        $this->expirationDateTime = $expirationDateTime;
    }

    /**
     * @param mixed $billPaymentMethodsType
     */
    public function setBillPaymentMethodsType($billPaymentMethodsType): void
    {
        $this->billPaymentMethodsType[] = $billPaymentMethodsType;
    }

    /**
     * @return mixed
     */
    public function getBillId()
    {
        return $this->billId;
    }

    /**
     * @return mixed
     */
    public function getAmount(): Amount
    {
        return $this->amount;
    }

    /**
     * @return mixed
     */
    public function getExpirationDateTime()
    {
        return $this->expirationDateTime;
    }

    /**
     * @return mixed
     */
    public function getBillPaymentMethodsType()
    {
        return $this->billPaymentMethodsType;
    }

}
