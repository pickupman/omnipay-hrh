<?php
/**
 * Hrh Abstract Request
 */

namespace Omnipay\Hrh\Message;

/**
 * Hrh Abstract Request
 *
 * This class forms the base class for Hrh requests
 *
 */
abstract class AbstractRequest extends \Omnipay\Common\Message\AbstractRequest
{
    protected $liveEndpoint = 'https://hrh.transactiongateway.com/api/transact.php';
    protected $testEndpoint = 'https://hrh.transactiongateway.com/api/transact.php';
    protected $action;

    public function getApiKey()
    {
        return $this->getSecurityKey();
    }

    public function setApiKey($value)
    {
        return $this->setSecurityKey('security_key', $value);
    }

    public function getUsername()
    {
        return $this->getParameter('username');
    }

    public function setUsername()
    {
        return $this->setParameter('username');
    }

    public function getPassword()
    {
        return $this->getParameter('password');
    }

    public function setPassword($value)
    {
        return $this->setParameter('password', $value);
    }

    public function getSecurityKey()
    {
        return $this->getParameter('security_key');
    }

    public function setSecurityKey($value)
    {
        return $this->getParameter('security_key');
    }

    public function getTransactionType()
    {
        if ($this->getParameter('type')) {
            return $this->getParameter('type');
        }
        return 'sale';
    }

    /**
     * Sets the transaction type
     * One of Values: 'sale', 'auth', 'credit', 'validate', or 'offline'
     */
    public function setTransactionType($value)
    {
        return $this->setParameter('type', $value);
    }

    public function getShippingMethod()
    {
        return $this->getParameter('shippingMethod');
    }

    public function setShippingMethod($value)
    {
        return $this->setParameter('shippingMethod', $value);
    }

    public function getInvoiceReference()
    {
        return $this->getParameter('invoiceReference');
    }

    public function setInvoiceReference($value)
    {
        return $this->setParameter('invoiceReference', $value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderid');
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderid', $value);
    }


    /**
     * @return string|NULL
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param string $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    protected function getBaseData()
    {
        $data = array();

        $card = $this->getCard();
        if ($card) {
            $data = array(
                // Login Information
                'username' => ($this->getTestMode()) ? 'demo' : $this->getUsername(),
                'password' => ($this->getTestMode()) ? 'password' : $this->getPassword(),

                // Billing Information
                'firstname' => $card->getFirstName(),
                'lastname'  => $card->getLastName(),
                'company'   => $card->getCompany(),
                'address1'  => $card->getAddress1(),
                'address2'  => $card->getAddress2(),
                'city'      => $card->getCity(),
                'state'     => $card->getState(),
                'zip'       => $card->getPostCode(),
                'country'   => strtolower($card->getCountry()),
                'email'     => $card->getEmail(),
                'phone'     => $card->getPhone(),

                // Shipping Information
                'shipping_firstname' => $card->getShippingFirstName(),
                'shipping_lastname'  => $card->getShippingLastName(),
                'shipping_address1'  => $card->getShippingAddress1(),
                'shipping_city'      => $card->getShippingCity(),
                'shipping_state'     => $card->getShippingState(),
                'shipping_zip'       => $card->getShippingPostCode(),
                'shipping_country'   => strtolower($card->getShippingCountry()),
                'shipping_phone'     => $card->getShippingPhone(),
            );

            $data['ShippingAddress']['Phone'] = $card->getShippingPhone();
        }

        return $data;
    }

    public function getEndpointBase()
    {
        return $this->getTestMode() ? $this->testEndpoint : $this->liveEndpoint;
    }
}