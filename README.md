# razorpay-php

[![Build Status](https://travis-ci.org/razorpay/razorpay-php.svg?branch=master)](https://travis-ci.org/razorpay/razorpay-php) [![Stable](https://img.shields.io/badge/stable-v2.8.0-blue.svg)](https://packagist.org/packages/razorpay/razorpay#2.8.0) [![License](https://poser.pugx.org/razorpay/razorpay/license.svg)](https://packagist.org/packages/razorpay/razorpay)

Official PHP library for [Razorpay API](https://docs.razorpay.com/docs/payments).

Read up here for getting started and understanding the payment flow with Razorpay: <https://docs.razorpay.com/docs/getting-started>

### Prerequisites
- A minimum of PHP 7.3 upto 8.1


## Installation

-   If your project using composer, run the below command

```
composer require razorpay/razorpay:2.*
```

- If you are not using composer, download the latest release from [the releases section](https://github.com/razorpay/razorpay-php/releases).
    **You should download the `razorpay-php.zip` file**.
    After that, include `Razorpay.php` in your application and you can use the API as usual.

##Note:
This PHP library follows the following practices:

- Namespaced under `Razorpay\Api`
- API throws exceptions instead of returning errors
- Options are passed as an array instead of multiple arguments wherever possible
- All requests and responses are communicated over JSON

## Documentation

Documentation of Razorpay's API and their usage is available at <https://docs.razorpay.com>

## Basic Usage

Instantiate the razorpay php instance with `key_id` & `key_secret`. You can obtain the keys from the dashboard app ([https://dashboard.razorpay.com/#/app/keys](https://dashboard.razorpay.com/#/app/keys))

```php
use Razorpay\Api\Api;

$api = new Api($api_key, $api_secret);
```

### Using Access Token
Instantiate the razorpay instance with `access_token`. The `access_token` can be obtained only in case if you are a platform partner. For more information, refer page - https://razorpay.com/docs/partners/platform/.

```php
use Razorpay\Api\Api;

$api = new Api(null, null, "<ACCESS_TOKEN>");
```

The resources can be accessed via the `$api` object. All the methods invocations follows the following pattern

```php
    // $api->class->function() to access the API
    //Example
    $api->payment->fetch($paymentId);
```
## Supported Resources
- [Account](documents/account.md)
- [Customer](documents/customer.md)
- [Dispute](documents/dispute.md)
- [Document](documents/document.md)
- [Token](documents/token.md)
- [Order](documents/order.md)
- [Payments](documents/payment.md)
- [Settlements](documents/settlement.md)
- [Refunds](documents/refund.md)
- [Fund](documents/fund.md)
- [Invoice](documents/invoice.md)
- [Iin](documents/Iin.md)
- [Plan](documents/plan.md)
- [Item](documents/item.md)
- [Subscriptions](documents/subscription.md)
- [Add-on](documents/addon.md)
- [Payment Links](documents/paymentLink.md)
- [Product Configuration](documents/productConfiguration.md)
- [Smart Collect](documents/virtualaccount.md)
- [Stakeholder](documents/stakeholder.md)
- [Transfer](documents/transfer.md)
- [QR Code](documents/qrcode.md)
- [Emandate](documents/emandate.md)
- [Cards](documents/card.md)
- [Paper NACH](documents/papernach.md)
- [UPI](documents/upi.md)
- [Register Emandate and Charge First Payment Together](documents/registeremandate.md)
- [Register NACH and Charge First Payment Together](documents/registernach.md)
- [Payment Verification](documents/paymentVerfication.md)
- [Webhook](documents/webhook.md)
- [OAuthTokenClient](documents/oAuthTokenClient.md)


## Development

See the [doc.md](doc.md) file for getting started with development.

## Release

Steps to follow for a release:

0. Merge the branch with the new code to master.
1. Bump the Version in `src/Api.php`.
2. Rename Unreleased to the new tag in `CHANGELOG.md`
3. Add a new empty "Unreleased" section at the top of `CHANGELOG.md`
4. Fix links at bottom in `CHANGELOG.md`
5. Commit
6. Tag the release and push to GitHub
7. A release should automatically be created once the travis build passes. Edit the release to add some description.

## License

The Razorpay PHP SDK is released under the MIT License. See [LICENSE](LICENSE) file for more details.
