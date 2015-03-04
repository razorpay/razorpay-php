#Introduction

[![Build Status](https://travis-ci.org/Razorpay/razorpay-php.svg?branch=master)](https://travis-ci.org/Razorpay/razorpay-php) [![Latest Stable Version](https://poser.pugx.org/razorpay/razorpay/v/stable.svg)](https://packagist.org/packages/razorpay/razorpay) [![License](https://poser.pugx.org/razorpay/razorpay/license.svg)](https://packagist.org/packages/razorpay/razorpay)

Razorpay client PHP Api. The api follows the following practices:

- namespaced under Razorpay\Api
- call $api->class->function() to access the api
- api throws exceptions instead of returning errors
- options are passed as a hash instead of multiple arguments wherever possible
- All request and responses are communicated over JSON

#Installation
- If your project uses composer, add following to composer.json
```json
{
    "require": {
        "razorpay/razorpay": "1.*"
    }
}
```
- Otherwise, clone/download this repo inside your project
- Install Composer on your system and do `composer install` in the repo root.
- Require/Include the `Razorpay.php` file in this repo wherever you want to use the API.
 
#Usage

```php
use Razorpay\Api\Api
$api = new Razorpay($api_key);
$api->payment->list($options);//Returns array of payment objects
$api->payment->get($id);//Returns a particular payment
$api->payment->capture($id);//capture a payment, returns error instead of throwing
$api->payment->refund($id);//refunds a payment
```

#Installation Instructions

First, you will need to [install composer][composer-install]. After that, install
the package by putting the following in your `composer.json`:

    {
      "require": {
        "razorpay/razorpay": ">=1.0"
      }
    }

Then, run `composer update`.

For further help, see our documentation on <https://docs.razorpay.com>.

[composer-install]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx
