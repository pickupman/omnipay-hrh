<?php
namespace Omnipay\Hrh\Message;

// use Omnipay\Hrh\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Hrh Void Request
 *
 * This is the request that will be called for any transaction which is voided
 */
class VoidRequest extends AbstractRequest
{
    public function getData()
    {
         // An amount and transactionReference parameter is required.
         $this->validate('transactionReference');

         $data = array(
             'transactionid' => $this->getTransactionReference(),
             'type'          => 'void'
         );

         return $data;
    }

}