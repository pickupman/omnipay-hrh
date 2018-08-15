# Omnipay: Hrh

**Hrh driver for the Omnipay PHP payment processing library**

[![Latest Stable Version](https://poser.pugx.org/pickupman/omnipay-Hrh/version.png)](https://packagist.org/packages/pickupman/omnipay-hrh)
[![Total Downloads](https://poser.pugx.org/pickupman/omnipay-Hrh/d/total.png)](https://packagist.org/packages/pickupman/omnipay-hrh)

[Omnipay](https://github.com/thephpleague/omnipay) is a framework agnostic, multi-gateway payment
processing library for PHP 5.3+. This package implements Hrh support for Omnipay.

## Installation

Omnipay is installed via [Composer](http://getcomposer.org/). To install, simply add it
to your `composer.json` file:

```json
{
    "require": {
        "pickupman/omnipay-hrh": "~1.0"
    }
}
```

And run composer to update your dependencies:

    $ curl -s http://getcomposer.org/installer | php
    $ php composer.phar update

## Basic Usage

The following gateways are provided by this package:

* High Risk Holdings (Hrh)

For general usage instructions, please see the main [Omnipay](https://github.com/thephpleague/omnipay)
repository.

## Purchase / Sale

For charging a card you may do the following

```php
$gateway = Omnipay\Omnipay::create('Hrh');
$gateway->setUsername('username');
$gateway->setPassword('password');

// Example card data
$card = new Omnipay\Common\CreditCard([
    'firstName'       => 'John',
    'lastName'        => 'Doe',
    'billingAddress1' => '888 Main',
    'billingZip'      => '77777',
    'billingCity'     => 'City',
    'billingState'    => 'State',
    'billingPostcode' => 'Zip',
    'number'          => '4111111111111111',
    'expiryMonth'     => '6',
    'expiryYear'      => '2016',
    'cvv'             => '123'
]);

$response = $gateway->purchase(
		         [
			         'card'                 => $card,
			         'amount'               => '10.00',
			         'clientIp'             => $_SERVER['REMOTE_ADDR'],
			         'transactionReference' => '1',
		         ]
		     )->send();

if ( $response->isSuccessful() ) {
	// Continue processing
	$transactionID = $response->getTransactionReference();
}
```

## Refund / Credit

In order to process a refund, you must pass the originating transaction id returned by the gateway

```php
$gateway = Omnipay\Omnipay::create('Hrh');
$gateway->setUsername('username');
$gateway->setPassword('password');

$response = $gateway->refund(
		         [
			         'amount'               => '10.00',
			         'transactionReference' => 'original transactionid',
		         ]
		     )->send();

if ( $response->isSuccessful() ) {
	// Continue processing
	$transactionID = $response->getTransactionReference();
}
```

## Void

To void an existing transaction, you must pass the originating transaction id returned by the gateway

```php
$gateway = Omnipay\Omnipay::create('Hrh');
$gateway->setUsername('username');
$gateway->setPassword('password');

$response = $gateway->void(
		         [
			         'transactionReference' => 'original transactionid',
		         ]
		     )->send();

if ( $response->isSuccessful() ) {
	// Continue processing
	$transactionID = $response->getTransactionReference();
}
```

## Authorize

You can authorize a credit card to verify funds, and then process the amount later.

```php
$gateway = Omnipay\Omnipay::create('Hrh');
$gateway->setUsername('username');
$gateway->setPassword('password');

// Example card data
$card = new Omnipay\Common\CreditCard([
    'firstName'       => 'John',
    'lastName'        => 'Doe',
    'billingAddress1' => '888 Main',
    'billingZip'      => '77777',
    'billingCity'     => 'City',
    'billingState'    => 'State',
    'billingPostcode' => 'Zip',
    'number'          => '4111111111111111',
    'expiryMonth'     => '6',
    'expiryYear'      => '2016',
    'cvv'             => '123'
]);

$response = $gateway->authorize(
		         [
			         'card'                 => $card,
			         'amount'               => '10.00',
			         'transactionReference' => 'order id or other unique value',
		         ]
		     )->send();

if ( $response->isSuccessful() ) {
	// Continue processing
	$transactionID = $response->getTransactionReference(); // Use this value later to capture
}
```

## Capture

Use a capture, to charge a card after retrieving an authorization

```php
$gateway = Omnipay\Omnipay::create('Hrh');
$gateway->setUsername('username');
$gateway->setPassword('password');

$response = $gateway->capture(
		         [
			         'amount'               => '10.00',
			         'transactionReference' => 'order id or other unique value',
		         ]
		     )->send();

if ( $response->isSuccessful() ) {
	// Continue processing
	$transactionID = $response->getTransactionReference(); // Use this value later to capture
}
```

## Test Mode

This feature will *NOT* turn on test mode for your account. Test mode must be enabled or disabled from your Hrh control panel. All transactions processed on a live account will be charged.

If you would like to use the default testing credentials from Hrh, please initialize the gateway with

```php
$gateway = Omnipay\Omnipay::create('Hrh');
$gateway->setTestMode(true); // Automatically sets default testing gateway username and password
```

Any transactions processed with testMode(true) will not be charged, *OR* shown in your control panel. This method will automatically apply the testing username and password for the Hrh gateway.

## Support

If you are having general issues with Omnipay, we suggest posting on
[Stack Overflow](http://stackoverflow.com/). Be sure to add the
[omnipay tag](http://stackoverflow.com/questions/tagged/omnipay) so it can be easily found.

If you want to keep up to date with release anouncements, discuss ideas for the project,
or ask more detailed questions, there is also a [mailing list](https://groups.google.com/forum/#!forum/omnipay) which
you can subscribe to.

If you believe you have found a bug, please report it using the [GitHub issue tracker](https://github.com/pickupman/omnipay-hrh/issues),
or better yet, fork the library and submit a pull request.