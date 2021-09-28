## Emandates

### Create customer
```php
$api->customer->create(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com','contact'=>'9123456780','notes'=> array('notes_key_1'=> 'Tea, Earl Grey, Hot','notes_key_2'=> 'Tea, Earl Grey… decaf'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| name*          | string      | Name of the customer                        |
| email        | string      | Email of the customer                       |
| contact      | string      | Contact number of the customer              |
| notes         | array      | A key-value pair                            |

-------------------------------------------------------------------------------------------------------

### Create order

```php
$api->order->create(array('amount' => 0,'currency' => 'INR','method' => 'emandate','customer_id' => 'cust_1Aa00000000001','receipt' => 'Receipt No. 1','notes' => array('notes_key_1' => 'Beam me up Scotty','notes_key_2' => 'Engage'),'token' => array('auth_type' => 'netbanking','max_amount' => 9999900,'expire_at' => 4102444799,'notes' => array('notes_key_1' => 'Tea, Earl Grey, Hot','notes_key_2' => 'Tea, Earl Grey… decaf.'),'bank_account' => array('beneficiary_name' => 'Gaurav Kumar','account_number' => '1121431121541121','account_type' => 'savings','ifsc_code' => 'HDFC0000001'))));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| amount*          | integer | Amount of the order to be paid                                               |
| currency*        | string  | Currency of the order. Currently only `INR` is supported.                      |
| method*        | string  | The authorization method. In this case the value will be `emandate`                      |
| receipt         | string  | Your system order reference id.                                              |
| notes           | array  | A key-value pair                                                             |
| token           | array  | A key-value pair                                                             |

-------------------------------------------------------------------------------------------------------

### Create an Authorization Payment

Please refer this [doc](https://razorpay.com/docs/api/recurring-payments/emandate/authorization-transaction/#113-create-an-authorization-payment) for authorization payment

-------------------------------------------------------------------------------------------------------

### Create registration link

```php
$api->subscription->createSubscriptionRegistration(array('customer'=>array('name'=>'Gaurav Kumar','email'=>'gaurav.kumar@example.com','contact'=>'9123456780'),'type'=>'link','amount'=>100,'currency'=>'INR','description'=>'Registration Link for Gaurav Kumar','subscription_registration'=>array('method'=>'card','max_amount'=>'500','expire_at'=>'1634215992'),'receipt'=>'Receipt No. 5','email_notify'=>1,'sms_notify'=>1,'expire_by'=>1634215992,'notes' => array('note_key 1' => 'Beam me up Scotty','note_key 2' => 'Tea. Earl Gray. Hot.')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| customer          | array | Details of the customer to whom the registration link will be sent.           |
| type*        | string  | In this case, the value is `link`.                      |
| currency*        | string  | The 3-letter ISO currency code for the payment. Currently, only `INR` is supported. |
| amount*         | integer  | The payment amount in the smallest currency sub-unit.                 |
| description*    | string  | A description that appears on the hosted page. For example, `12:30 p.m. Thali meals (Gaurav Kumar`).                                                             |
| subscription_registration           | array  | Details of the authorization payment.                      |
| notes           | array  | A key-value pair                                                             |

-------------------------------------------------------------------------------------------------------

### Send/Resend notifications

```php
$api->invoice->fetch($invoiceId)->notify($medium);
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*          | string | The id of the invoice to be notified                         |
| medium*          | string | `sms`/`email`, Medium through which notification should be sent.                         |
-------------------------------------------------------------------------------------------------------

### Cancel a registration link

```php
$api->invoice->fetch($invoiceId)->cancel();
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*          | string | The id of the invoice to be cancelled                         |
-------------------------------------------------------------------------------------------------------

### Fetch token by payment ID

```php
$api->payment->fetch($paymentId);
```

**Parameters:**

| Name       | Type   | Description                       |
|------------|--------|-----------------------------------|
| paymentId* | string | Id of the payment to be retrieved |

-------------------------------------------------------------------------------------------------------

### Fetch tokens by customer ID

```php
$api->customer->fetch($customerId)->tokens()->all();
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*          | string      | The id of the customer to be fetched |

-------------------------------------------------------------------------------------------------------

### Delete token

```php
$api->customer->fetch($customerId)->tokens()->delete($tokenId);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*          | string      | The id of the customer to be fetched |
| tokenId*          | string      | The id of the token to be fetched |

-------------------------------------------------------------------------------------------------------

### Create an order to charge the customer

```php
$api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| amount*          | integer | Amount of the order to be paid                                               |
| currency*        | string  | Currency of the order. Currently only `INR` is supported.                      |
| receipt         | string  | Your system order reference id.                                              |
| notes           | array  | A key-value pair                                                             |

-------------------------------------------------------------------------------------------------------

### Create an order to charge the customer

```php
$api->payment->createRecurring(array('email'=>'gaurav.kumar@example.com','contact'=>'9123456789','amount'=>100,'currency'=>'INR','order_id'=>'order_1Aa00000000002','customer_id'=>'cust_1Aa00000000001','token'=>'token_1Aa00000000001','recurring'=>'1','description'=>'Creating recurring payment for Gaurav Kumar'));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| email*          | string | The customer's email address.                                               |
| contact*        | string  | The customer's phone number.                      |
| amount*         | integer  | The amount you want to charge your customer. This should be the same as the amount in the order.                        |
| currency*        | string  | The 3-letter ISO currency code for the payment. Currently, only `INR` is supported. |
| order_id*        | string  | The unique identifier of the order created. |
| customer_id*        | string  | The `customer_id` for the customer you want to charge.  |
| token*        | string  | The `token_id` generated when the customer successfully completes the authorization payment. Different payment instruments for the same customer have different `token_id`.|
| recurring*        | string  | Determines if recurring payment is enabled or not. Possible values:<br>* `1` - Recurring is enabled.* `0` - Recurring is not enabled.|
| description*        | string  | A user-entered description for the payment.|
| notes*        | array  | Key-value pair that can be used to store additional information about the entity. Maximum 15 key-value pairs, 256 characters (maximum) each. |

-------------------------------------------------------------------------------------------------------



**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/recurring-payments/emandate/authorization-transaction/)**
