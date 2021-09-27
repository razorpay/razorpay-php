## Cards

### Create customer
```php
$api->customer->create(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com','contact'=>'9123456780', 'fail_existing'=> '0', 'notes'=> array('notes_key_1'=> 'Tea, Earl Grey, Hot','notes_key_2'=> 'Tea, Earl Grey… decaf'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| name*          | string      | Name of the customer                        |
| email        | string      | Email of the customer                       |
| contact      | string      | Contact number of the customer              |
| fail_existing | string | If a customer with the same details already exists, the request throws an exception by default. Possible value is `0` or `1`|
| notes         | array      | A key-value pair                            |

-------------------------------------------------------------------------------------------------------

### Create Order

```php
$api->order->create(array('amount' => 100, 'currency' => 'INR',  'receipt' => '123', 'method'=>'card', 'token'=>array('max_amount'=>'5000', 'expire_at'=>'2709971120', 'frequency'=>'monthly'), 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| amount*   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |
| currency*   | string  | The currency of the payment (defaults to INR)  |
| receipt      | string  | Your system order reference id.  |
| method      | string  | Payment method used to make the registration transaction. Possible value is `card`.  |
| token  | array  | All keys listed [here] https://razorpay.com/docs/api/recurring-payments/cards/authorization-transaction/#112-create-an-order are supported |
| notes | array  | A key-value pair  |

-------------------------------------------------------------------------------------------------------

### Create registration link

```php
$api->subscription->createSubscriptionRegistration(array('customer'=>array('name'=>'Gaurav Kumar','email'=>'gaurav.kumar@example.com','contact'=>'9123456780'),'type'=>'link','amount'=>100,'currency'=>'INR','description'=>'Registration Link for Gaurav Kumar','subscription_registration'=>array('method'=>'card','max_amount'=>'500','expire_at'=>'1634215992'),'receipt'=>'Receipt No. 5','email_notify'=>1,'sms_notify'=>1,'expire_by'=>1634215992));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| customer   | array      | Details of the customer to whom the registration link will be sent. |
| type*  | array | the value is `link`. |
| amount*   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |
| currency*   | string  | The currency of the payment (defaults to INR)  |
| description*  | string      | A brief description of the payment.   |
| subscription_registration   | array  | All keys listed [here] https://razorpay.com/docs/api/recurring-payments/cards/authorization-transaction/#121-create-a-registration-link are supported  |
| receipt      | string  | Your system order reference id.  |
| sms_notify  | boolean  | SMS notifications are to be sent by Razorpay (default : 1)  |
| email_notify | boolean  | Email notifications are to be sent by Razorpay (default : 1)  |
| expire_by    | integer | The timestamp, in Unix format, till when the customer can make the authorization payment. |
| notes | array  | A key-value pair  |
-------------------------------------------------------------------------------------------------------

## Create an order to charge the customer

```php
$api->order->create(array('amount' => '100', 'currency' => 'INR', 'customer_id'=> $customerId, 'method'=>'card',  'receipt' => 'Receipt No. 1', 'token'=>array('max_amount'=>'5000', 'expire_at'=>'2709971120', 'frequency'=>'monthly'), 'notes'=> array('key1'=> 'value3','key2'=> 'value2'))); 
```
**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| amount*   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |
| currency*   | string  | The currency of the payment (defaults to INR)  |
| customerId*   | string      | The id of the customer to be fetched |
| method      | string  | Payment method used to make the registration transaction. Possible value is `card`.  |
| receipt      | string  | Your system order reference id.  |
| token  | array  | All keys listed [here] https://razorpay.com/docs/api/recurring-payments/cards/subsequent-payments/#31-create-an-order-to-charge-the-customer are supported |
| notes | array  | A key-value pair  |

-------------------------------------------------------------------------------------------------------

## Create a recurring payment

```php
$api->payment->createRecurring(['email'=>'gaurav.kumar@example.com','contact'=>'9123456789','amount'=>100,'currency'=>'INR','order_id'=>$orderid,'customer_id'=>$customerId,'token'=>$tokenId,'recurring'=>'1','description'=>'Creating recurring payment for Gaurav Kumar', 'notes'=> array('key1'=> 'value3','key2'=> 'value2'))); 
```
**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| email*   | string      | The customer's email address |
| contact*   | string      | The customer's phone number |
| amount*   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |
| currency*   | string  | The currency of the payment (defaults to INR)  |
| orderId*   | string      | The id of the order to be fetched |
| customerId*   | string      | The id of the customer to be fetched |
| tokenId*   | string      | The id of the token to be fetched |
| recurring*   | boolean      | Possible values is `0` or `1` |
| description  | string      | A brief description of the payment.   |
| notes | array  | A key-value pair  |

-------------------------------------------------------------------------------------------------------

## Send/Resend notifications

```php
$api->invoice->fetch($invoiceId)->notifyBy($medium);
```
**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*   | string      | The id of the invoice to be fetched |
| medium*   | string      | Possible values are `sms` or `email` |

-------------------------------------------------------------------------------------------------------

## Cancel registration link

```php
$api->invoice->fetch($invoiceId)->cancel();
```
**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*   | string      | The id of the invoice to be fetched |

-------------------------------------------------------------------------------------------------------

## Fetch token by payment id

```php
$api->payment->fetch($paymentId);
```
**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched |

-------------------------------------------------------------------------------------------------------

## Fetch tokens by customer id

```php
$api->customer->fetch($customerId)->tokens()->all();
```
**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| customerId*   | string      | The id of the customer to be fetched |

-------------------------------------------------------------------------------------------------------

### Fetch card

```php
$api->card->fetch($cardId);
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| cardId*          | string | card id to be fetched                                               |

-------------------------------------------------------------------------------------------------------

## Delete tokens

```php
$api->customer->fetch($customerId)->tokens()->delete($tokenId);
```
**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| customerId*   | string      | The id of the customer to be fetched |
| tokenId*   | string      | The id of the token to be fetched |

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
