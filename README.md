#Introduction

[![Build Status](https://travis-ci.org/Razorpay/razorpay-php.svg?branch=master)](https://travis-ci.org/Razorpay/razorpay-php)

Razorpay client PHP Api. The api follows the following practices:

- namespaced under
- call $api->class->function() to access the api
- api throws exceptions instead of returning errors
- options are passed as a hash instead of multiple arguments wherever possible
- All request and responses are communicated over JSON

#Usage

```php
use Razorpay\Api
$api = new Razorpay($api_key);
$api->payment->list($options);//Returns array of payment objects
$api->payment->get($id);//Returns a particular payment
$api->payment->capture($id);//capture a payment, returns error instead of throwing
$api->payment->refund($id);//refunds a payment
```
