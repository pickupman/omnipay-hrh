<?php
namespace Omnipay\Hrh\Message;

// use Omnipay\Hrh\Message\AbstractRequest;
use Omnipay\Common\Message\ResponseInterface;

/**
 * Hrh Capture Request
 *
 * This is the request that will be called for any transaction which to capture a offline authorization
 */
class CaptureRequest extends AbstractRequest
{
    public function getData()
    {
        // An amount and transactionReference parameter is required.
        $this->validate('amount', 'transactionReference');

        $data = array(
            'amount'        => $this->getAmount(),
            'transactionid' => $this->getTransactionReference(),
            'type'          => 'capture'
        );

        return $data;
    }

}