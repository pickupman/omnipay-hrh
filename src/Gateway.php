<?php
namespace Omnipay\Hrh;

use Omnipay\Common\AbstractGateway;


class Gateway extends AbstractGateway
{
    public function getName()
    {
        return 'Hrh';
    }

    public function getDefaultParameters()
    {
        return array(
            'username',
            'password',
            'security_key',
            'testMode',
        );
    }

    public function getUsername()
    {
        $this->getParameter('username');
    }

    public function setUsername($value)
    {
        return $this->setParameter('username', $value);
    }

    public function getPassword()
    {
        return $this->getParameter('password', $value);
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
        return $this->setParameter('security_key', $value);
    }

    public function getApiKey()
    {
        return $this->getSecurityKey();
    }

    public function setApiKey($value)
    {
        return $this->setSecurityKey($value);
    }

    public function getOrderId()
    {
        return $this->getParameter('orderid');
    }

    public function setOrderId($value)
    {
        return $this->setParameter('orderid', $value);
    }

    public function getTestMode()
    {
        return $this->getParameter('testMode');
    }

    public function setTestMode($value)
    {
        return $this->setParameter('testMode', $value);
    }

    public function authorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Hrh\Message\AuthorizeRequest', $parameters);
    }

    public function purchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Hrh\Message\PurchaseRequest', $parameters);
    }

    public function completeAuthorize(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Hrh\Message\AuthorizeRequest', $parameters);
    }

    public function capture(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Hrh\Message\CaptureRequest', $parameters);
    }

    public function completePurchase(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Hrh\Message\PurchaseRequest', $parameters);
    }

    public function refund(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Hrh\Message\RefundRequest', $parameters);
    }

    public function void(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Hrh\Message\VoidRequest', $parameters);
    }

    public function createCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Hrh\Message\CreditCardRequest', $parameters);
    }

    public function updateCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Hrh\Message\CardReferenceRequest', $parameters);
    }

    public function deleteCard(array $parameters = array())
    {
        return $this->createRequest('\Omnipay\Hrh\Message\CardReferenceRequest', $parameters);
    }
}