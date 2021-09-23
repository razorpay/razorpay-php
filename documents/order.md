## Orders

### Create order

```php
$api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| amount*          | integer | Amount of the order to be paid                                               |
| currency*        | string  | Currency of the order. Currently only INR is supported.                      |
| receipt         | string  | Your system order reference id.                                              |
| notes           | object  | A key-value pair                                                             |

-------------------------------------------------------------------------------------------------------

### Fetch all orders

```php
$api->order->all($options);
```

**Parameters**

| Name       | Type      | Description                                                  |
|------------|-----------|--------------------------------------------------------------|
| from       | timestamp | timestamp after which the orders were created              |
| to         | timestamp | timestamp before which the orders were created             |
| count      | integer   | number of orders to fetch (default: 10)                    |
| skip       | integer   | number of orders to be skipped (default: 0)                |
| authorized | boolean   | Orders for which orders are currently in authorized state. |
| receipt    | string    | Orders with the provided value for receipt.                  |

-------------------------------------------------------------------------------------------------------
### Fetch particular order

```php
$api->order->fetch($orderId);
```
**Parameters**

| Name     | Type   | Description                         |
|----------|--------|-------------------------------------|
| orderId* | string | The id of the order to be retrieved |

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

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/orders/)**
