<?php
namespace Omnipay\Hrh\Message;

// use Omnipay\Hrh\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Hrh Authorize/Purchase Request
 *
 * This is the request that will be called for any transaction which submits a credit card,
 * including `authorize` and `purchase`
 */
class AuthorizeRequest extends PurchaseRequest
{
    public function getData()
    {
        $data = parent::getData();
        $data['type'] = 'auth';

        return $data;
    }

}