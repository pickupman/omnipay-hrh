<?php
namespace Omnipay\Hrh\Message;

use Omnipay\Common\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Hrh Authorize/Purchase Request
 *
 * This is the request that will be called for any transaction which submits a credit card,
 * including `authorize` and `purchase`
 */
class CreditCardRequest extends AbstractRequest
{
    public function getData()
    {
        $this->validate('amount', 'card', 'username', 'password', 'orderid');

        $this->getCard()->validate();

        return array('amount' => $this->getAmount());
    }

    public function sendData($data)
    {
        $data['type'] = 'sale';

        return $this->response = new Response($this, $data);
    }
}