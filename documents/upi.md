## UPI

### Create customer
```php
$api->customer->create(array(
  'name' => 'Gaurav Kumar', 
  'email' => 'gaurav.kumar@example.com', 
  'fail_existing' => "1", 
  'contact'=>'9000090000',
  'notes'=> array(
    'notes_key_1'=> 'Tea, Earl Grey, Hot',
    'notes_key_2'=> 'Tea, Earl Grey... decaf'
   )
));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| name*          | string      | Name of the customer                        |
| email        | string      | Email of the customer                       |
| fail_existing | string | If a customer with the same details already exists, the request throws an exception by default. Possible value is `1` or `0`|
| contact      | string      | Contact number of the customer              |
| notes         | array      | A key-value pair                            |

**Response:**
```json
{
  "id": "cust_1Aa00000000003",
  "entity": "customer",
  "name": "Gaurav Kumar",
  "email": "Gaurav.Kumar@example.com",
  "contact": "9000000000",
  "gstin": null,
  "notes": {
    "notes_key_1": "Tea, Earl Grey, Hot",
    "notes_key_2": "Tea, Earl Grey… decaf."
  },
  "created_at": 1582033731
}
```

-------------------------------------------------------------------------------------------------------

### Create order

```php
$api->order->create(array('amount' => 0,'currency' => 'INR','method' => 'upi','customer_id' => 'cust_4xbQrmEoA5WJ01', 'token' => array('max_amount' => 200000, 'expire_at' => 2709971120, 'frequency' => 'monthly'),'receipt' => 'Receipt No. 1' ,'notes' => array('notes_key_1' => 'Beam me up Scotty','notes_key_2' => 'Engage')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| amount*          | integer | Amount of the order to be paid                                               |
| currency*        | string  | Currency of the order. Currently only `INR` is supported.                      |
| method*        | string  | The authorization method. In this case the value will be `upi`                      |
| receipt         | string  | Your system order reference id.                                              |
| notes           | array  | A key-value pair                                                             |
| token*  | array  | All parameters listed [here](https://razorpay.com/docs/api/payments/recurring-payments/upi/create-authorization-transaction/#112-create-an-order) are supported  |

**Response:**
```json
{
  "id": "order_1Aa00000000002",
  "entity": "order",
  "amount": 100,
  "amount_paid": 0,
  "amount_due": 100,
  "currency": "INR",
  "receipt": "Receipt No. 1",
  "offer_id": null,
  "status": "created",
  "attempts": 0,
  "notes": {
    "notes_key_1": "Tea, Earl Grey, Hot",
    "notes_key_2": "Tea, Earl Grey… decaf."
    },
  "created_at": 1565172642
}
```
-------------------------------------------------------------------------------------------------------

### Create an Authorization Payment

Please refer this [doc](https://razorpay.com/docs/api/recurring-payments/upi/authorization-transaction/#113-create-an-authorization-payment) for authorization payment

-------------------------------------------------------------------------------------------------------

### Create registration link

```php
$api->subscription->createSubscriptionRegistration(array(
    'customer' => array(
        'name' => 'Gaurav Kumar',
        'email' => 'gaurav.kumar@example.com',
        'contact' => '9123456780'
    ),
    'type' => 'link',
    'amount' => 100,
    'currency' => 'INR',
    'description' => 'Registration Link for Gaurav Kumar',
    'subscription_registration' => array(
        'method' => 'upi',
        'max_amount' => '500',
        'expire_at' => '1634215992',
        'frequency' => 'monthly'
    ),
    'receipt' => 'Receipt No. 5',
    'email_notify' => true,
    'sms_notify' => true,
    'expire_by' => 1634215992,
    'notes' => array(
        'note_key 1' => 'Beam me up Scotty',
        'note_key 2' => 'Tea. Earl Gray. Hot.'
    )
));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| customer   | array      | All parameters listed [here](https://razorpay.com/docs/api/payments/recurring-payments/upi/create-authorization-transaction/#121-create-a-registration-link) are supported |
| type*        | string  | In this case, the value is `link`.                      |
| currency*        | string  | The 3-letter ISO currency code for the payment. Currently, only `INR` is supported. |
| amount*         | integer  | The payment amount in the smallest currency sub-unit.                 |
| description*    | string  | A description that appears on the hosted page. For example, `12:30 p.m. Thali meals (Gaurav Kumar`).                                                             |
| subscription_registration      | array  | All parameters listed [here](https://razorpay.com/docs/api/payments/recurring-payments/upi/create-authorization-transaction/#121-create-a-registration-link) are supported |
| sms_notify  | boolean  | SMS notifications are to be sent by Razorpay (default : true)  |
| email_notify | boolean  | Email notifications are to be sent by Razorpay (default : true)  |
| expire_by    | integer | The timestamp, in Unix format, till when the customer can make the authorization payment. |
| notes | array  | A key-value pair  |

**Response:**
```json
{
  "id": "inv_FHr1ekX0r2VCVK",
  "entity": "invoice",
  "receipt": "Receipt No. 23",
  "invoice_number": "Receipt No. 23",
  "customer_id": "cust_BMB3EwbqnqZ2EI",
  "customer_details": {
    "id": "cust_BMB3EwbqnqZ2EI",
    "name": "Gaurav Kumar",
    "email": "gaurav.kumar@example.com",
    "contact": "9123456780",
    "gstin": null,
    "billing_address": null,
    "shipping_address": null,
    "customer_name": "Gaurav Kumar",
    "customer_email": "gaurav.kumar@example.com",
    "customer_contact": "9123456780"
  },
  "order_id": "order_FHr1ehR3nmNeXo",
  "line_items": [],
  "payment_id": null,
  "status": "issued",
  "expire_by": 4102444799,
  "issued_at": 1595489219,
  "paid_at": null,
  "cancelled_at": null,
  "expired_at": null,
  "sms_status": "pending",
  "email_status": "pending",
  "date": 1595489219,
  "terms": null,
  "partial_payment": false,
  "gross_amount": 100,
  "tax_amount": 0,
  "taxable_amount": 0,
  "amount": 100,
  "amount_paid": 0,
  "amount_due": 100,
  "currency": "INR",
  "currency_symbol": "₹",
  "description": "Registration Link for Gaurav Kumar",
  "notes": {
    "note_key 1": "Beam me up Scotty",
    "note_key 2": "Tea. Earl Gray. Hot."
  },
  "comment": null,
  "short_url": "https://rzp.io/i/ak1WxDB",
  "view_less": true,
  "billing_start": null,
  "billing_end": null,
  "type": "link",
  "group_taxes_discounts": false,
  "created_at": 1595489219,
  "idempotency_key": null
}
```
-------------------------------------------------------------------------------------------------------

### Send/Resend notifications

```php
$api->invoice->fetch($invoiceId)->notifyBy($medium);
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*          | string | The id of the invoice to be notified                         |
| medium*          | string | `sms`/`email`, Medium through which notification should be sent.                         |

**Response:**
```json
{
    "success": true
}
```
-------------------------------------------------------------------------------------------------------

### Cancel a registration link

```php
$api->invoice->fetch($invoiceId)->cancel();
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*          | string | The id of the invoice to be cancelled                         |

**Response:**
```json
{
    "amount": 100,
    "amount_due": 100,
    "amount_paid": 0,
    "auth_link_status": "cancelled",
    "billing_end": null,
    "billing_start": null,
    "cancelled_at": 1655110334,
    "comment": null,
    "created_at": 1655110315,
    "currency": "INR",
    "currency_symbol": "₹",
    "customer_details": {
        "billing_address": null,
        "contact": "9123456780",
        "customer_contact": "9123456780",
        "customer_email": "gaurav.kumar@example.com",
        "customer_name": "Gaurav Kumar",
        "email": "gaurav.kumar@example.com",
        "gstin": null,
        "id": "cust_DzYEzfJLV03rkp",
        "name": "Gaurav Kumar",
        "shipping_address": null
    },
    "customer_id": "cust_DzYEzfJLV03rkp",
    "date": 1655110315,
    "description": "Registration Link for Gaurav Kumar",
    "email_status": "sent",
    "entity": "invoice",
    "expire_by": 1657699317,
    "expired_at": null,
    "first_payment_min_amount": null,
    "gross_amount": 100,
    "group_taxes_discounts": false,
    "id": "inv_Jgv4UErmFzfrA0",
    "idempotency_key": null,
    "invoice_number": "Receipt No. #51",
    "issued_at": 1655110315,
    "line_items": [],
    "notes": {
        "note_key 1": "Beam me up Scotty",
        "note_key 2": "Tea. Earl Gray. Hot."
    },
    "order_id": "order_Jgv4UAyqlixvOB",
    "paid_at": null,
    "partial_payment": false,
    "payment_id": null,
    "receipt": "Receipt No. #51",
    "reminder_status": null,
    "short_url": "https://rzp.io/i/VuAC1WG",
    "sms_status": "sent",
    "status": "cancelled",
    "subscription_status": null,
    "supply_state_code": null,
    "tax_amount": 0,
    "taxable_amount": 0,
    "terms": null,
    "type": "link",
    "user_id": null,
    "view_less": true
}
```
-------------------------------------------------------------------------------------------------------

### Fetch token by payment ID

```php
$api->payment->fetch($paymentId);
```

**Parameters:**

| Name       | Type   | Description                       |
|------------|--------|-----------------------------------|
| paymentId* | string | Id of the payment to be retrieved |

**Response:**
```json
{
  "id": "pay_FHfAzEJ51k8NLj",
  "entity": "payment",
  "amount": 100,
  "currency": "INR",
  "status": "captured",
  "order_id": "order_FHfANdTUYeP8lb",
  "invoice_id": null,
  "international": false,
  "method": "upi",
  "amount_refunded": 0,
  "refund_status": null,
  "captured": true,
  "description": null,
  "card_id": null,
  "bank": null,
  "wallet": null,
  "vpa": "gaurav.kumar@upi",
  "email": "gaurav.kumar@example.com",
  "contact": "+919876543210",
  "customer_id": "cust_DtHaBuooGHTuyZ",
  "token_id": "token_FHfAzGzREc1ug6",
  "notes": {
    "note_key 1": "Beam me up Scotty",
    "note_key 2": "Tea. Earl Gray. Hot."
  },
  "fee": 0,
  "tax": 0,
  "error_code": null,
  "error_description": null,
  "error_source": null,
  "error_step": null,
  "error_reason": null,
  "acquirer_data": {
    "rrn": "854977234911",
    "upi_transaction_id": "D0BED5A062ECDB3E9B3A1071C96BB273"
  },
  "created_at": 1595447490
}
```
-------------------------------------------------------------------------------------------------------

### Fetch tokens by customer ID

```php
$api->customer->fetch($customerId)->tokens()->all();
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*          | string      | The id of the customer to be fetched |

**Response:**
```json
{
  "entity": "collection",
  "count": 1,
  "items": [
    {
      "id": "token_FHfAzGzREc1ug6",
      "entity": "token",
      "token": "9KHsdPaCELeQ0t",
      "bank": null,
      "wallet": null,
      "method": "upi",
      "vpa": {
        "username": "gaurav.kumar",
        "handle": "upi",
        "name": null
      },
      "recurring": true,
      "recurring_details": {
        "status": "confirmed",
        "failure_reason": null
      },
      "auth_type": null,
      "mrn": null,
      "used_at": 1595447490,
      "created_at": 1595447490,
      "start_time": 1595447455,
      "dcc_enabled": false
    }
  ]
}
```
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

**Response:**
```json
{
    "deleted": true
}
```
-------------------------------------------------------------------------------------------------------

### Create an order to charge the customer

```php
$api->order->create(array('amount' => 1000,'currency' => 'INR','payment_capture' => true,'receipt' => 'Receipt No. 1','notes'=> array('notes_key_1' => 'Tea, Earl Grey, Hot', 'notes_key_2' => 'Tea, Earl Grey… decaf.')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| amount*          | integer | Amount of the order to be paid                                               |
| currency*        | string  | Currency of the order. Currently only `INR` is supported.                      |
| receipt         | string  | Your system order reference id.                                              |
| notes           | array  | A key-value pair  |
| payment_capture  | boolean  | Indicates whether payment status should be changed to captured automatically or not. Possible values: true - Payments are captured automatically. false - Payments are not captured automatically. |

**Response:**
```json
{
   "id":"order_1Aa00000000002",
   "entity":"order",
   "amount":1000,
   "amount_paid":0,
   "amount_due":1000,
   "currency":"INR",
   "receipt":"Receipt No. 1",
   "offer_id":null,
   "status":"created",
   "attempts":0,
   "notes":{
      "notes_key_1":"Tea, Earl Grey, Hot",
      "notes_key_2":"Tea, Earl Grey… decaf."
   },
   "created_at":1579782776
}
```
-------------------------------------------------------------------------------------------------------

### Create a recurring payment

```php
$api->payment->createRecurring(array(
    'email'       => 'gaurav.kumar@example.com',
    'contact'     => '9000090000',
    'amount'      => 100,
    'currency'    => 'INR',
    'order_id'    => 'order_1Aa00000000002',
    'customer_id' => 'cust_1Aa00000000001',
    'token'       => 'token_1Aa00000000001',
    'recurring'   => true,
    'description' => 'Creating recurring payment for Gaurav Kumar'
));
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
| recurring*        | string  | Determines if recurring payment is enabled or not. Possible values:<br>* `true` - Recurring is enabled.* `false` - Recurring is not enabled.|
| description        | string  | A user-entered description for the payment.|
| notes        | array  | Key-value pair that can be used to store additional information about the entity. Maximum 15 key-value pairs, 256 characters (maximum) each. |

**Response:**
```json
{
  "razorpay_payment_id" : "pay_1Aa00000000001",
  "razorpay_order_id" : "order_1Aa00000000001",
  "razorpay_signature" : "9ef4dffbfd84f1318f6739a3ce19f9d85851857ae648f114332d8401e0949a3d"
}
```
-------------------------------------------------------------------------------------------------------



**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/recurring-payments/upi/authorization-transaction/)**
