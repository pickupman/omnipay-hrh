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
class PurchaseRequest extends AbstractRequest
{
    public function getData()
    {
        // An amount and transactionReference parameter is required.
        $this->validate('amount', 'transactionReference');

        $data = array(
            'amount'           => $this->getAmount(),
            'orderid'          => $this->getTransactionReference(),
            'ipaddress'        => $this->getClientIp(),
            'orderdescription' => '',
            'type'             => 'sale'
        );
        // A card token can be provided if the card has been stored
        // in the gateway.
        if ($this->getCardReference())
        {
            $data['transactionid'] = $this->getCardReference();
            // Check for a level of continuity level
            if ( $this->getLevelOfContinuity() )
            {
                $data['merchant_defined_field_2']  = $this->getLevelOfContinuity();
                $data['merchant_defined_field_12'] = 'VAULT';
            }
        // If no card token is provided then there must be a valid
        // card presented.
        }
        else
        {
            $this->validate('card');
            $card = $this->getCard();
            $card->validate();
            $data = array_merge($data, $this->getBaseData());
        }

        return $data;
    }

}