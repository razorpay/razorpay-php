## Refunds

### Create a normal refund
```php
$api->payment->fetch($paymentId)->refund(array("amount"=> "100", "speed"=>"normal", "notes"=>array("notes_key_1"=>"Beam me up Scotty.", "notes_key_2"=>"Engage"), "receipt"=>"Receipt No. 31"));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
|  paymentId*   | string      | The id of the payment                       |
|  amount       | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |                       |
|  speed        | string      | Here, it must be normal                |
|  notes        | array       | A key-value pair                |
|  receipt      | string      | A unique identifier provided by you for your internal reference. |

-------------------------------------------------------------------------------------------------------

### Create an instant refund
```php
$api->payment->fetch($paymentId)->refund(array("amount"=> "100","speed"=>"optimum","receipt"=>"Receipt No. 31"));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
|  paymentId*  | string      | The id of the payment                       |
|  amount       | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |
|  speed*        | string      | Here, it must be optimum                    |
|  receipt      | string      | A unique identifier provided by you for your internal reference. |

-------------------------------------------------------------------------------------------------------

### Fetch multiple refunds for a payment
```php
$api->payment->fetch($paymentId)->fetchMultipleRefund($option);
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| paymentId*  | string      | The id of the payment                       |
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch a specific refund for a payment
```php
$api->payment->fetch($paymentId)->fetchRefund($refundId);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
|  paymentId*   | string      | The id of the payment to be fetched        |
|  refundId*   | string      | The id of the refund to be fetched           |

-------------------------------------------------------------------------------------------------------

### Fetch all refunds
```php
$api->refund->all($options);
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch particular refund
```php
$api->refund->fetch($refundId);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
|  refundId*   | string      | The id of the refund to be fetched           |

-------------------------------------------------------------------------------------------------------

### Update the refund
```php
$api->refund->fetch($refundId)->edit(array('notes'=> array('notes_key_1'=>'Beam me up Scotty.', 'notes_key_2'=>'Engage')));
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| refundId*   | string    | The id of the refund to be fetched     |
| notes* | array  | A key-value pair                                 |

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/refunds/)**
