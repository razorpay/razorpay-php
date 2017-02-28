# razorpay-php

[![Build Status](https://travis-ci.org/razorpay/razorpay-php.svg?branch=master)](https://travis-ci.org/razorpay/razorpay-php) [![Latest Stable Version](https://poser.pugx.org/razorpay/razorpay/v/stable.svg)](https://packagist.org/packages/razorpay/razorpay) [![License](https://poser.pugx.org/razorpay/razorpay/license.svg)](https://packagist.org/packages/razorpay/razorpay)

Razorpay client PHP Api. The api follows the following practices:

- namespaced under Razorpay\Api
- call $api->class->function() to access the api
- api throws exceptions instead of returning errors
- options are passed as an array instead of multiple arguments wherever possible
- All request and responses are communicated over JSON
- A minimum of PHP 5.3 is required

# Installation

- If your project uses composer, add following to composer.json
```json
{
    "require": {
        "razorpay/razorpay": "1.*"
    }
}
```

Then, run `composer update`. If you are not using composer, download
the latest release from [the releases section](https://github.com/razorpay/razorpay-php/releases).
**You should download the `razorpay-php.zip` file**.

After that include `Razorpay.php` in your application and you can use the
API as usual.

# Usage

```php
use Razorpay\Api\Api;

$api = new Api($api_key, $api_secret);
$order = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR')); // Creates order
$order = $api->order->fetch($orderId); // Returns a particular order
$api->order->all($options); // Returns array of order objects
$api->payment->all($options); // Returns array of payment objects
$payment = $api->payment->fetch($id); // Returns a particular payment
$api->payment->fetch($id)->capture(array('amount'=>$amount)); // Captures a payment
$api->refund->create(array('payment_id' => $id)); // Creates refund for a payment
$api->refund->create(array('payment_id' => $id, 'amount'=>$refundAmount)); // Creates partial refund for a payment
$refund = $api->refund->fetch($refundId); // Returns a particular refund
$card = $api->card->fetch($cardId); // Returns a particular card
$customer = $api->customer->create(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com')); // Creates customer
$customer = $api->customer->fetch($customerId); // Returns a particular customer
$api->customer->edit(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com')); // Edits customer
$token = $api->customer->token()->fetch($tokenId); // Returns a particular token
$api->customer->token()->all($options); // Returns array of token objects
$api->customer->token()->delete($tokenId); // Deletes a token

// To get the payment details
echo $payment->amount;
echo $payment->currency;
// And so on for other attributes
```

For further help, see our documentation on <https://docs.razorpay.com>.

[composer-install]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx

## Developing

See the [doc.md](doc.md) file for getting started with development.

## License

The Razorpay PHP SDK is released under the MIT License.

## Release

Steps to follow for a release:

0. Merge the branch with the new code to master.
1. Bump the Version in `src/Api.php`.
2. Rename Unreleased to the new tag in `CHANGELOG.md`
3. Add a new empty "Unreleased" section at the top of `CHANGELOG.md`
3. Fix links at bottom in `CHANGELOG.md`
4. Commit
5. Tag the release and push to GitHub
6. A release should automatically be created once the travis build passes. Edit the release to add some description.
