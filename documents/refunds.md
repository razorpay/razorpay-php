## Refunds

### Fetch Refund by ID
```php
$api->payment->fetch($paymentId);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
|  paymentId*          | string      | The id of the payment                       |

-------------------------------------------------------------------------------------------------------

### Create a Normal Refund
```php
$api->payment->fetch($paymentId)->refund(["amount"=> "100"]);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
|  paymentId*          | string      | The id of the payment                       |
|  amount       | string      | The amount to be captured (should be equal to the authorized amount, in paise) |                       |

-------------------------------------------------------------------------------------------------------

### Create an Instant Refund
```php
$api->payment->fetch($paymentId)->refund(["amount"=> "100","speed"=>"optimum","receipt"=>"Receipt No. 31"]);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
|  paymentId*   | string      | The id of the payment                       |
|  amount       | string      | The amount to be captured (should be equal to the authorized amount, in paise) |
|  speed        | string      | Here, it must be optimum                    |
|  receipt      | string      | A unique identifier provided by you for your internal reference. |

-------------------------------------------------------------------------------------------------------

### Fetch Multiple Refunds for a Payment
```php
$option = array('from'=> 1631099841,'to'=> 1631099852,'count'=> 1);
$api->payment->fetch($paymentId)->fetchMultipleRefund($option);
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
|  paymentId*   | string      | The id of the payment                  |
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch All Refunds
```php
$api->refund->all();
```
-------------------------------------------------------------------------------------------------------

### Update the Refund
```php
$api->refund->fetch($refundId)->edit(array('notes'=> array('notes_key_1'=>'Beam me up Scotty.', 'notes_key_2'=>'Engage')));
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| refundId*   | string    | The id of the refund                             |
| notes* | object   | A key-value pair                                 |

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/refunds/)**