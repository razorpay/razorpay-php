# razorpay-php

[![Build Status](https://travis-ci.org/razorpay/razorpay-php.svg?branch=master)](https://travis-ci.org/razorpay/razorpay-php) [![Latest Stable Version](https://poser.pugx.org/razorpay/razorpay/v/stable.svg)](https://packagist.org/packages/razorpay/razorpay) [![License](https://poser.pugx.org/razorpay/razorpay/license.svg)](https://packagist.org/packages/razorpay/razorpay)

Razorpay client PHP API. The Api follows the following practices:

-   Namespaced under `Razorpay\Api`
-   Call `$api->class->function()` to access the API
-   API throws exceptions instead of returning errors
-   Options are passed as an array instead of multiple arguments wherever possible
-   All requests and responses are communicated over JSON
-   A minimum of PHP 5.3 is required

# Installation

-   If your project uses composer, run the below command

```
composer require razorpay/razorpay:2.*
```

-   If you are not using composer, download the latest release from [the releases section](https://github.com/razorpay/razorpay-php/releases).
    **You should download the `razorpay-php.zip` file**.
    After that, include `Razorpay.php` in your application and you can use the API as usual.

# Usage

```php
use Razorpay\Api\Api;

$api = new Api($api_key, $api_secret);

// Orders
$order  = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR')); // Creates order
$orderId = $order['id']; // Get the created Order ID
$order  = $api->order->fetch($orderId);
$orders = $api->order->all($options); // Returns array of order objects
$payments = $api->order->fetch($orderId)->payments(); // Returns array of payment objects against an order

// Payments
$payments = $api->payment->all($options); // Returns array of payment objects
$payment  = $api->payment->fetch($id); // Returns a particular payment
$payment  = $api->payment->fetch($id)->capture(array('amount'=>$amount)); // Captures a payment

// To get the payment details
echo $payment->amount;
echo $payment->currency;
// And so on for other attributes

// Refunds
$refund = $api->refund->create(array('payment_id' => $id)); // Creates refund for a payment
$refund = $api->refund->create(array('payment_id' => $id, 'amount'=>$refundAmount)); // Creates partial refund for a payment
$refund = $api->refund->fetch($refundId); // Returns a particular refund

// Cards
$card = $api->card->fetch($cardId); // Returns a particular card

// Customers
$customer = $api->customer->create(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com')); // Creates customer
$customer = $api->customer->fetch($customerId); // Returns a particular customer
$customer = $api->customer->edit(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com')); // Edits customer

// Tokens
$token  = $api->customer->token()->fetch($tokenId); // Returns a particular token
$tokens = $api->customer->token()->all($options); // Returns array of token objects
$api->customer->token()->delete($tokenId); // Deletes a token


// Transfers
$transfer  = $api->payment->fetch($paymentId)->transfer(array('transfers' => [ ['account' => $accountId, 'amount' => 100, 'currency' => 'INR']])); // Create transfer
$transfers = $api->transfer->all(); // Fetch all transfers
$transfers = $api->payment->fetch($paymentId)->transfers(); // Fetch all transfers created on a payment
$transfer  = $api->transfer->fetch($transferId)->edit($options); // Edit a transfer
$reversal  = $api->transfer->fetch($transferId)->reverse(); // Reverse a transfer

// Payment Links
$links = $api->payment_link->all(); // fetch all payment links
$link  = $api->payment_link->fetch('plink_GiwM9xbIZqbkJp'); // fetch payment link with id
$link = $api->payment_link->create(array('amount' => 98765,'description' => 'For XYZ purpose', 'customer' => array('email' => 'test@test.test'))); // create payment link
$link  = $api->payment_link->fetch('plink_GiwM9xbIZqbkJp')->cancel(); //cancel payment link

// Invoices
$invoices = $api->invoice->all();
$invoice  = $api->invoice->fetch('inv_00000000000001');
$invoice  = $api->invoice->create($params); // Ref: razorpay.com/docs/invoices for request params example
$invoice  = $invoice->edit($params);
$invoice->issue();
$invoice->notifyBy('email');
$invoice->cancel();
$invoice->delete();

// Virtual Accounts
$virtualAccount  = $api->virtualAccount->create(array('receivers' => array('types'=> arra('bank_account')),'allowed_payers' => array(array('type'=>'bank_account','bank_account'=>array('ifsc'=>'RATN0VAAPIS','account_number'=>'2223330027558515'))),'description' => 'Virtual Account created for Raftar','customer_id' => 'cust_HssUOFiOd2b1TJ', 'notes' => array('project_name' => 'Banking Software')));  //Create a Virtual Account

$virtualAccount = $api->virtualAccount->fetch('va_HubTH8fZ4tnBnP')->addReceiver(array('types' => array('vpa'),'vpa' => array('descriptor'=>'gauravkumar'))); // Add Receiver to an Existing Virtual Account
$options = array('from'=> 1631099841,'to'=> 1631099852,'count'=> 1);
$virtualAccount = $api->virtualAccount->all($options); // Fetch All Virtual Accounts

$virtualAccount  = $api->virtualAccount->fetch('va_4xbQrmEoA5WJ0G'); // Fetch a Virtual Account by ID
$virtualAccount  = $virtualAccount->close(); // Close a Virtual Account

$options = array('from'=> 1631099841,'to'=> 1631099852,'count'=> 1);
$virtualAccount = $virtualAccount->payments($options); // Fetch Payments made to a Virtual Account
$bankTransfer    = $api->payment->fetch('pay_8JpVEWsoNPKdQh')->bankTransfer(); // Fetch Payment Details using ID and Transfer Method

// Smart Collect TPV APIs
$smartCollect = $api->virtualAccount->create(array('receivers' => array('types'=> arra('bank_account')),'allowed_payers' => array(array('type'=>'bank_account','bank_account'=>array('ifsc'=>'RATN0VAAPIS','account_number'=>'2223330027558515'))),'description' => 'Virtual Account created for Raftar','customer_id' => 'cust_HssUOFiOd2b1TJ', 'notes' => array('project_name' => 'Banking Software')));  //Create a Virtual Account
$smartCollect = $api->virtualAccount->fetch('va_4xbQrmEoA5WJ0G'); // Fetch a Virtual Account by ID

$options = array('from'=> 1631099841,'to'=> 1631099852,'count'=> 1);
$smartCollect = $api->virtualAccount->all($options); // Fetch All Virtual Accounts
$smartCollect = $api->payment->fetch('pay_8JpVEWsoNPKdQh')->bankTransfer(); // Fetch Payment Details using ID and Transfer Method

$options = array('from'=> 1631099841,'to'=> 1631099852,'count'=> 1);
$smartCollect = $virtualAccount->payments($options); // Fetch Payments made to a Virtual Account
$smartCollect = $api->virtualAccount->fetch('va_HubTH8fZ4tnBnP')->addReceiver(array('types' => array('vpa'),'vpa' => array('descriptor'=>'gauravkumar'))); // Add Receiver to an Existing Virtual Account
$smartCollect  = $virtualAccount->close(); // Close a Virtual Account

// Bharat QR
$bharatQR = $api->virtualAccount->create(array('receivers' => array('types' => array('qr_code')), 'description' => 'First QR code', 'amount_expected' => 100, 'notes' => array('receiver_key' => 'receiver_value'))); // Create Static QR
$bharatQR = $api->virtualAccount->create(array('receivers' => array('types' => array('qr_code')), 'description' => 'First QR code', 'notes' => array('receiver_key' => 'receiver_value'))); // Create Dynamic QR

// QR Code
$qrCode = $api->qrCode->create(array("type" => "upi_qr","name" => "Store_1", "usage" => "single_use","fixed_amount" => 1,"payment_amount" => 300,"customer_id" => "cust_HKsR5se84c5LTO","description" => "For Store 1","close_by" => 1681615838,"notes" => array("purpose" => "Test UPI QR code notes"))); // Create QR Code
$qrCode = $api->qrCode->create(array("type" => "upi_qr","name" => "Store_1", "usage" => "single_use","fixed_amount" => 1,"payment_amount" => 300,"customer_id" => "cust_HKsR5se84c5LTO","description" => "For Store 1","close_by" => 1681615838,"notes" => array("purpose" => "Test UPI QR code notes"),"tax_invoice" => array("number" => "INV001", "date" => 1589994898,"customer_name" => "Gaurav Kumar", "business_gstin"=> "06AABCU9605R1ZR","gst_amount" => 4000, "cess_amount" => 0, "supply_type" => "interstate"))); // Create QR Code GST
$closeQRCode = $api->qrCode->fetch('qr_HMsVL8HOpbMcjU')->close() // Close QR code
$qrCode = $api->qrCode->fetch('qr_HMsVL8HOpbMcjU') // Fetch particular QR code
$qrCode = $api->qrCode->all(["customer_id" => 'cust_HKsR5se84c5LTO']) // Fetch QR code for particular customer id
$qrCode = $api->qrCode->all(["payment_id" => 'pay_Di5iqCqA1WEHq6']) // Fetch QR code for particular payment id
$qrCode = $api->qrCode->all() // Fetch all QR code
$qrCode = $api->qrCode->fetch('qr_HMsVL8HOpbMcjU')->fetchAllPayments() // Fetch Payments for a QR Code

// Subscriptions
$plan          = $api->plan->create(array('period' => 'weekly', 'interval' => 1, 'item' => array('name' => 'Test Weekly 1 plan', 'description' => 'Description for the weekly 1 plan', 'amount' => 600, 'currency' => 'INR')));
$plan          = $api->plan->fetch('plan_7wAosPWtrkhqZw');
$plans         = $api->plan->all();
$subscription  = $api->subscription->create(array('plan_id' => 'plan_7wAosPWtrkhqZw', 'customer_notify' => 1, 'total_count' => 6, 'start_at' => 1495995837, 'addons' => array(array('item' => array('name' => 'Delivery charges', 'amount' => 30000, 'currency' => 'INR')))));  // Create a Subscription

$subscription = $api->subscription->create(array('plan_id' => 'plan_HoYg68p5kmuvzD','total_count' => 12,'quantity' => 1,'expire_by' => 1633237807,'customer_notify' => 1, 'addons' => array(array('item'=>array('name' => 'Delivery charges','amount' => 30000,'currency' => 'INR'))),'offer_id' => 'offer_HrkIvgue2Uneqd','notes'=>array('notes_key_1'=>'Tea, Earl Grey, Hot','notes_key_2'=>'Tea, Earl Grey… decaf.'),'notify_info'=>array('notify_phone' => '9123456789','notify_email'=> 'gaurav.kumar@example.com')));  // Create a Subscription Link

$subscription  = $api->subscription->fetch('sub_82uBGfpFK47AlA'); // Fetch Subscription by ID
$subscriptions = $api->subscription->all(); // Fetch All Subscriptions
$subscription  = $api->subscription->fetch('sub_82uBGfpFK47AlA')->cancel($options); //$options = ['cancel_at_cycle_end' => 1];
$subscription  = $api->subscription->fetch('sub_82uBGfpFK47AlA')->update($options); //$options = ['plan_id'=>'plan_00000000000002','offer_id'=>'offer_JHD834hjbxzhd38d','schedule_change_at'=>'cycle_end','quantity'=>5];  //Update a Subscription
$subscription  = $api->subscription->fetch('sub_82uBGfpFK47AlA')->pendingUpdate(); // Fetch Details of Pending Update
$subscription =  $api->subscription->fetch('sub_82uBGfpFK47AlA')->cancelAtNextCycle(); // Cancel an update
$subscription =  $api->subscription->fetch('sub_82uBGfpFK47AlA')->pause(['pause_at'=>'now']); // Pause Subscription
$subscription =  $api->subscription->fetch('sub_82uBGfpFK47AlA')->resume(['resume_at'=>'now']); // Resume Subscription
$subscription =  $api->subscription->fetch('sub_82uBGfpFK47AlA')->deleteOffer('offer_JHD834hjbxzhd38d') // Delete an Offer Linked to a Subscription
$subscription = $api->invoice->all(['subscription_id'=>'sub_HvNIkQUz9I5GBA']); // Fetch All Invoices for a Subscription
//For authentication transaction in subscription please refer this link https://razorpay.com/docs/api/subscriptions/#authentication-transaction

$attributes = array( 'razorpay_signature' => $razorpaySignature, 'razorpay_payment_id' => $razorpayPaymentId, 'razorpay_subscription_id' => $razorpaySubscriptionId);
$subscription = $api->utility->verifyPaymentSignature($attributes); // Payment Verification


$addon         = $api->addon->fetchAll($option); // Fetch all Add-ons
$addon         = $api->subscription->fetch('sub_82uBGfpFK47AlA')->createAddon(array('item' => array('name' => 'Extra Chair', 'amount' => 30000, 'currency' => 'INR'), 'quantity' => 2)); // Create an Add-on
$addon         = $api->addon->fetch('ao_8nDvQYYGQI5o4H');
$addon         = $api->addon->fetch('ao_8nDvQYYGQI5o4H')->delete();


// Settlements
$settlement    = $api->settlement->fetch('setl_7IZKKI4Pnt2kEe');
$settlements   = $api->settlement->all();
$reports       = $api->settlement->reports(array('year' => 2018, 'month' => 2));
```

For further help, see our documentation on <https://docs.razorpay.com>.

[composer-install]: https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx

## Developing

See the [doc.md](doc.md) file for getting started with development.

## License

The Razorpay PHP SDK is released under the MIT License. See [LICENSE](LICENSE) file for more details.

## Release

Steps to follow for a release:

0.  Merge the branch with the new code to master.
1.  Bump the Version in `src/Api.php`.
1.  Rename Unreleased to the new tag in `CHANGELOG.md`
1.  Add a new empty "Unreleased" section at the top of `CHANGELOG.md`
1.  Fix links at bottom in `CHANGELOG.md`
1.  Commit
1.  Tag the release and push to GitHub
1.  A release should automatically be created once the travis build passes. Edit the release to add some description.
