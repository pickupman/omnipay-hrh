<?php
namespace Omnipay\Hrh\Message;

use Omnipay\Common\Message\AbstractResponse;
use Omnipay\Common\Message\AbstractRequest;

/**
 * Hrh Response
 *
 * This is the response class for all Hrh requests.
 *
 * @see \Omnipay\Hrh\Gateway
 */
class Response extends AbstractResponse
{
    public function __construct(AbstractRequest $request, $data)
    {
        parse_str($data, $responseData);
        $data = $responseData;
dd($data);
        parent::__construct($request, $data);
    }
    public function isSuccessful()
    {
        return ($this->data['response'] == 1) && $this->data['success'];
    }

    public function getTransactionReference()
    {
        return isset($this->data['transactionid']) ? $this->data['transactionid'] : null;
    }

    public function getTransactionId()
    {
        return isset($this->data['transactionid']) ? $this->data['transactionid'] : null;
    }

    public function getCardReference()
    {
        return null;
    }

    public function getMessage()
    {
        return isset($this->data['responsetext']) ? $this->data['responsetext'] : null;
    }
}