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
$order  = $api->order->create(array('amount' => 1000, 'currency' => 'INR','transfers' => [ ['account' => 'acc_HjVXbtpSCIxENR', 'amount' => 500, 'currency' => 'INR']])); // Creates transfers from order

// Payments
$payments = $api->payment->all($options); // Returns array of payment objects
$payment  = $api->payment->fetch($id); // Returns a particular payment
$payment  = $api->payment->fetch($id)->capture(array('amount'=>$amount)); // Captures a payment
$payments = $api->payment->all(array('X-Razorpay-Account'=>'acc_HjVXbtpSCIxENR')); // Fetch payments of a linked account

// To get the payment details
echo $payment->amount;
echo $payment->currency;
// And so on for other attributes

// Refunds
$refund = $api->refund->create(array('payment_id' => $id)); // Creates refund for a payment
$refund = $api->refund->create(array('payment_id' => $id, 'amount'=>$refundAmount)); // Creates partial refund for a payment
$refund = $api->refund->fetch($refundId); // Returns a particular refund

// Cards
$card = $api->customer->create(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com')); // Creates an customer
$card = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR')); // Creates an order
$card = $api->card->fetch($cardId); // Returns a particular card
$card = $api->subscription->createSubscriptionRegistration(array('customer'=>array('name'=>'Gaurav Kumar','email'=>'gaurav.kumar@example.com','contact'=>'9123456780'),'type'=>'link','amount'=>100,'currency'=>'INR','description'=>'Registration Link for Gaurav Kumar','subscription_registration'=>array('method'=>'card','max_amount'=>'500','expire_at'=>'1634215992'),'receipt'=>'Receipt No. 5','email_notify'=>1,'sms_notify'=>1,'expire_by'=>1634215992)); // Create a Registration Link

$card = $api->subscription->createSubscriptionRegistration(array('customer'=>array('name'=>'Gaurav Kumar','email'=>'gaurav.kumar@example.com','contact'=>'9123456780'),'type'=>'link','amount'=>100,'currency'=>'INR','description'=>'Registration Link for Gaurav Kumar','subscription_registration'=>array('method'=>'card','max_amount'=>'500','expire_at'=>'1634215992'),'receipt'=>'Receipt No. 5','email_notify'=>1,'sms_notify'=>1,'expire_by'=>1634215992)); // Create a Registration Link
$card = $api->invoice->fetch('inv_00000000000001')->notifyBy('sms'); // Send/Resend Notifications
$card = $api->payment->fetch($id); // Fetch Token by Payment ID
$card = $api->customer->fetch($customerId)->tokens()->all(); // Fetch Tokens by Customer ID
$card = $api->invoice->fetch('inv_00000000000001')->cancel(); // Cancel a Registration Link
$card = $api->customer->fetch($customerId)->tokens()->delete($tokenId); // Deletes a token
$card = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR')); // Create an Order to Charge the Customer

$card = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR')); // Create an Order to Charge the Customer
$card  = $api->customer->fetch($customerId)->tokens()->fetch($tokenId); // Returns a particular token
$card = $api->customer->fetch($customerId)->tokens()->delete($tokenId); // Deletes a token
$card = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR')); // Create an Order to Charge the Customer
$card = $api->payment->createRecurring(['email'=>'gaurav.kumar@example.com','contact'=>'9123456789','amount'=>100,'currency'=>'INR','order_id'=>'order_1Aa00000000002','customer_id'=>'cust_1Aa00000000001','token'=>'token_1Aa00000000001','recurring'=>'1','description'=>'Creating recurring payment for Gaurav Kumar']); // Create a Recurring Payment
//For payment authorization in cards refer this link https://razorpay.com/docs/api/recurring-payments/cards/authorization-transaction/#113-create-an-authorization-payment

//Register Emandate and Charge First Payment Together
$emandate = $api->customer->create(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com')); // Creates an customer
$emandate = $api->order->create(array('receipt' => 'Receipt No. 1', 'amount' => 100, 'currency' => 'INR','method'=>'emandate','customer_id'=>'cust_1Aa00000000001','notes'=>array('notes_key_1'=>'Beam me up Scotty','notes_key_2'=>'Engage'),'token'=>array('first_payment_amount'=>100,'auth_type'=>'netbanking','max_amount'=> 9999900,'expire_at'=>4102444799,'bank_account'=>array('beneficiary_name'=>'Gaurav Kumar','account_number'=>'1121431121541121','account_type'=>'savings','ifsc_code'=>'HDFC0000001')))); // Creates an order
$emandate = $api->subscription->createSubscriptionRegistration(array('customer'=>array('name'=>'Gaurav Kumar','email'=>'gaurav.kumar@example.com','contact'=>'9123456780'),'type'=>'link','amount'=>100,'currency'=>'INR','description'=>'Registration Link for Gaurav Kumar','subscription_registration'=>array('first_payment_amount'=>100,'method'=>'emandate','auth_type'=>'netbanking','expire_at'=>1634215992,'max_amount'=>50000,'bank_account'=>array('beneficiary_name'=>'Gaurav Kumar','account_number'=>'11214311215411','account_type'=>'savings','ifsc_code'=>'HDFC0001233')),'receipt'=>'Receipt No. 5','email_notify'=>1,'sms_notify'=>1,'expire_by'=>1634215992)); // Create a Registration Link
$emandate = $api->invoice->fetch('inv_00000000000001')->notifyBy('sms'); // Send/Resend Notifications
$emandate = $api->payment->fetch($id); // Fetch Token by Payment ID
$emandate = $api->customer->fetch($customerId)->tokens()->all(); // Fetch Tokens by Customer ID
$emandate = $api->invoice->fetch('inv_00000000000001')->cancel(); // Cancel a Registration Link
$emandate = $api->customer->fetch($customerId)->tokens()->delete($tokenId); // Deletes a token
$emandate = $api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR')); // Create an Order to Charge the Customer
$emandate = $api->payment->createRecurring(['email'=>'gaurav.kumar@example.com','contact'=>'9123456789','amount'=>100,'currency'=>'INR','order_id'=>'order_1Aa00000000002','customer_id'=>'cust_1Aa00000000001','token'=>'token_1Aa00000000001','recurring'=>'1','description'=>'Creating recurring payment for Gaurav Kumar']); // Create a Recurring Payment
//For payment authorization in "registration and charge first payment together" please refer this link https://razorpay.com/docs/api/recurring-payments/emandate/auto-debit/#113-create-an-authorization-payment

// Customers
$customer = $api->customer->create(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com')); // Creates customer
$customer = $api->customer->fetch($customerId); // Returns a particular customer
$customer = $api->customer->edit(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com')); // Edits customer

// Tokens
$token  = $api->customer->fetch($customerId)->tokens()->fetch($tokenId); // Returns a particular token
$tokens = $api->customer->fetch($customerId)->tokens()->all(); // Returns array of token objects
$tokens = $api->customer->fetch($customerId)->tokens()->delete($tokenId); // Deletes a token


// Transfers
$transfer  = $api->payment->fetch($paymentId)->transfer(array('transfers' => [ ['account' => $accountId, 'amount' => 100, 'currency' => 'INR']])); // Create transfer
$transfers = $api->transfer->all(); // Fetch all transfers
$transfers = $api->payment->fetch($paymentId)->transfers(); // Fetch all transfers created on a payment
$transfer  = $api->transfer->fetch($transferId)->edit($options); // Edit a transfer
$reversal  = $api->transfer->fetch($transferId)->reverse(); // Reverse a transfer
$transfer = $api->transfer->create(array('account' => 'acc_HjVXbtpSCIxENR', 'amount' => 500, 'currency' => 'INR')); // Creates direct transfer from merchant's account
$transfers = $api->order->fetch($orderId)->transfers(array('expand[]'=>'transfers')); // Fetch all transfers created on order
$transfer  = $api->transfer->fetch($transferId); // Fetch a transfer
$transfers = $api->transfer->all(array('recipient_settlement_id'=> $settlementId)); // Fetch all transfers made for particular settlement id
$transfers = $api->transfer->all(array('expand[]'=> 'recipient_settlement')); // Fetch settlement details along with transfers

// Payment Links
$links = $api->payment_link->all(); // fetch all payment links

$link  = $api->payment_link->fetch('plink_GiwM9xbIZqbkJp'); // fetch payment link with id

$data = json_encode(
    [
    'amount' => 98765,
    'description' => 'For XYZ purpose',
    'customer' => array('email' => 'test@test.test')
    ]);
$link->payment_link->create($data); // create payment link , pass $data.
$link  = $api->payment_link->fetch('plink_GiwM9xbIZqbkJp'); // cancel payment link , first fetch payment link with id and then call cancel method like $link->cancel();
$link->cancel();

$link->notifyBy('sms');
$links = $api->payment_link->all(); // fetch all payment links
$link  = $api->payment_link->fetch('plink_GiwM9xbIZqbkJp'); // fetch payment link with id
$link = $api->payment_link->create(array('amount' => 98765,'description' => 'For XYZ purpose', 'customer' => array('email' => 'test@test.test'))); // create payment link
$link  = $api->payment_link->fetch('plink_GiwM9xbIZqbkJp')->cancel(); //cancel payment link

$data = array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('hosted_page'=>array('label'=>array('receipt'=>'Ref No.', 'description'=>'Course Name', 'amount_payable'=>'Course Fee Payable', 'amount_paid'=>'Course Fee Paid', 'partial_amount_due'=>'Fee Installment Due', 'partial_amount_paid'=>'Fee Installment Paid', 'expire_by'=>'Pay Before', 'expired_on'=>'1632223497','amount_due'=>'Course Fee Due'), 'show_preferences'=>array('issued_to'=>false)))); // Rename Labels in Payment Details Section

$data = array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('theme'=>array('hide_topbar'=>'true')))); // Implement Thematic Changes in Payment Links Checkout Section 

$data = array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('method'=>array('netbanking'=>'1', 'card'=>'1', 'upi'=>'0', 'wallet'=>'0')))); // Customize Payment Methods

$data = array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('readonly'=>array('email'=>'1','contact'=>'1')))); // Set Checkout Fields as Read-Only

$data = array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('name'=>'Lacme Corp'))); // Change Business Name and Description

$data = array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('prefill'=>array('method'=>'card', 'card[name]'=>'Gaurav Kumar', 'card[number]'=>'4111111111111111', 'card[expiry]'=>'12/21', 'card[cvv]'=>'123')))); // Prefill Checkout Fields

$data = array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('partial_payment'=>array('min_amount_label'=>'Minimum Money to be paid', 'partial_amount_label'=>'Pay in parts', 'partial_amount_description'=>'Pay at least ₹100', 'full_amount_label'=>'Pay the entire amount')))); // Rename Labels in Checkout Section

$data = array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>false); // Managing Reminders for Payment Links

$data = array('amount'=>20000, 'currency'=>'INR', 'accept_partial'=>false, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>false , 'options'=>array('order'=>array('offers'=>array('offer_I0PqexIiTmMRnA')))); // Offers on Payment Links

$data = array('amount'=>20000, 'currency'=>'INR', 'accept_partial'=>false, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('order'=>array('transfers'=>array('account'=>'acc_CPRsN1LkFccllA', 'amount'=>500, 'currency'=>'INR', 'notes'=>array('branch'=>'Acme Corp Bangalore North', 'name'=>'Bhairav Kumar' ,'linked_account_notes'=>array('branch'))), array('account'=>'acc_CNo3jSI8OkFJJJ', 'amount'=>500, 'currency'=>'INR', 'notes'=>array('branch'=>'Acme Corp Bangalore North', 'name'=>'Saurav Kumar' ,'linked_account_notes'=>array('branch')))))); // Transfer Payments Received Using Payment Links

$link = $api->paymentLink->create($data); // create payment link 
$link = $api->paymentLink->fetch('plink_I0XKdzr2ZsXzY6')->notifyBy('sms'); // Resend Payment Link Notifications
$link  = $api->paymentLink->fetch('plink_I0UzjargpoC3Jp')->edit(["reference_id"=>"TS42", "expire_by"=>"1640270451" , "reminder_enable"=>0, "notes"=>["policy_name"=>"Jeevan Saral 2"]]); // Update a Payment Link

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


//Paper NACH
$customer = $api->customer->create(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com')); // Creates customer
$order  = $api->order->create(array ('amount' => 0,'currency' => 'INR','method' => 'nach','customer_id' => 'cust_1Aa00000000001','receipt' => 'Receipt No. 1','notes' => array ('notes_key_1' => 'Beam me up Scotty','notes_key_2' => 'Engage'),'token' => array ('auth_type' => 'physical','max_amount' => 10000000,'expire_at' => 2709971120,'notes' => array ('notes_key_1' => 'Tea, Earl Grey, Hot','notes_key_2' => 'Tea, Earl Grey… decaf.'),'bank_account' => array ('account_number' => '11214311215411','ifsc_code' => 'HDFC0000001','beneficiary_name' => 'Gaurav Kumar','account_type' => 'savings'),'nach' =>array ('form_reference1' => 'Recurring Payment for Gaurav Kumar','form_reference2' => 'Method Paper NACH','description' => 'Paper NACH Gaurav Kumar')))); // Creates order for paper Nach
$api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR')); // Creates an order to charge customer for paper nach
$api->subscription->createSubscriptionRegistration(array('customer'=>array('name'=>'Gaurav Kumar','email'=>'gaurav.kumar@example.com','contact'=>'9123456780'),'type'=>'link','amount'=>100,'currency'=>'INR','description'=>'Registration Link for Gaurav Kumar','subscription_registration'=>array('method'=>'card','max_amount'=>'500','expire_at'=>'1634215992'),'receipt'=>'Receipt No. 5','email_notify'=>1,'sms_notify'=>1,'expire_by'=>1634215992)); // Create a Registration Link
$api->invoice->fetch('inv_00000000000001')->notifyBy('sms'); // Send/Resend Notifications (can pass any one of the following sms/email)
$api->invoice->fetch('inv_00000000000001')->cancel() // Cancel a registration link for Paper NACH
$api->order->fetch($orderId)->payments(); // Fetch Payment ID using Order ID
$api->payment->fetch($id); //Fetch token by Payment ID
$api->customer->fetch($customerId)->tokens()->fetch($tokenId); // Fetch Tokens by Customer ID
$api->customer->fetch($customerId)->tokens()->delete($tokenId); // Deletes a token
$api->payment->createRecurring(['email'=>'gaurav.kumar@example.com','contact'=>'9123456789','amount'=>100,'currency'=>'INR','order_id'=>'order_1Aa00000000002','customer_id'=>'cust_1Aa00000000001','token'=>'token_1Aa00000000001','recurring'=>'1','description'=>'Creating recurring payment for Gaurav Kumar']); // Create a Recurring Payment
//For payment authoiraztion in Paper Nach please refer this link https://razorpay.com/docs/api/recurring-payments/paper-nach/authorization-transaction/#113-create-an-authorization-payment

//Register NACH and Charge First Payment together
$order  = $api->order->create(array ('amount' => 0,'currency' => 'INR','method' => 'nach','customer_id' => 'cust_1Aa00000000001','receipt' => 'Receipt No. 1','notes' => array ('notes_key_1' => 'Beam me up Scotty','notes_key_2' => 'Engage'),'token' => array ('first_payment_amount'=> 10000,'auth_type' => 'physical','max_amount' => 10000000,'expire_at' => 2709971120,'notes' => array ('notes_key_1' => 'Tea, Earl Grey, Hot','notes_key_2' => 'Tea, Earl Grey… decaf.'),'bank_account' => array ('account_number' => '11214311215411','ifsc_code' => 'HDFC0000001','beneficiary_name' => 'Gaurav Kumar','account_type' => 'savings'),'nach' =>array ('form_reference1' => 'Recurring Payment for Gaurav Kumar','form_reference2' => 'Method Paper NACH','description' => 'Paper NACH Gaurav Kumar')))); // Creates an order
$api->subscription->createSubscriptionRegistration(array('customer'=>array('name'=>'Gaurav Kumar','email'=>'gaurav.kumar@example.com','contact'=>'9123456780'),'type'=>'link','amount'=>100,'currency'=>'INR','description'=>'Registration Link for Gaurav Kumar','subscription_registration'=>array('first_payment_amount'=> 10000,'method'=>'nach','auth_type'=>'physical','max_amount'=>'500','expire_at'=>'1634215992','bank_account'=>array('beneficiary_name'=>'Gaurav Kumar','account_number'=>'11214311215411','account_type'=>'savings','ifsc_code'=>'HDFC0001233')),'receipt'=>'Receipt No. 5','email_notify'=>1,'sms_notify'=>1,'expire_by'=>1634215992)); // Create a Registration Link


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
