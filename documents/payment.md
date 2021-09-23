## Payments

### Capture payment

```php
$api->payment->fetch($paymentId)->capture(array('amount'=>$amount,'currency' => 'INR'));
```

**Parameters:**


| Name      | Type    | Description                                                                    |
|-----------|---------|--------------------------------------------------------------------------------|
| paymentId* | string  | Id of the payment to capture                                                   |
| amount*    | integer | The amount to be captured (should be equal to the authorized amount, in paise) |
| currency   | string  | The currency of the payment (defaults to INR)                                  |

-------------------------------------------------------------------------------------------------------

### Fetch all payments

```php
$api->payment->all($options)
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch a payment

```php
$api->payment->fetch($paymentId);
```

**Parameters:**

| Name       | Type   | Description                       |
|------------|--------|-----------------------------------|
| paymentId* | string | Id of the payment to be retrieved |

-------------------------------------------------------------------------------------------------------

### Fetch payments for an order

```php
$api->order->fetch($orderId)->payments();
```
**Parameters**

| Name     | Type   | Description                         |
|----------|--------|-------------------------------------|
| orderId* | string | The id of the order to be retrieve payment info |

-------------------------------------------------------------------------------------------------------

### Update a payment

```php
$api->payment->fetch($paymentId)->edit(array('notes'=> array('key_1'=> 'value1','key_2'=> 'value2')));
```

**Parameters:**

| Name        | Type    | Description                          |
|-------------|---------|--------------------------------------|
| paymentId* | string  | Id of the payment to update          |
| notes*       | object  | A key-value pair                     |

-------------------------------------------------------------------------------------------------------


**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/payments/)**
