## Transfers

### Create transfers from payment

```php
$api->payment->fetch($paymentId)->transfer(array('transfers' => array('account'=> $accountId, 'amount'=> '1000', 'currency'=>'INR', 'notes'=> array('name'=>'Gaurav Kumar', 'roll_no'=>'IEC2011025'), 'linked_account_notes'=>array('branch'), 'on_hold'=>'1', 'on_hold_until'=>'1671222870')));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |
| transfers   | array     | All parameters listed [here](https://razorpay.com/docs/api/route/#create-transfers-from-payments) are supported |

-------------------------------------------------------------------------------------------------------

### Create transfers from order

```php
$api->payment->fetch($paymentId)->transfer('amount'=>'1000', 'currency'=>'INR', array('transfers' => array('account'=> $accountId, 'amount'=> '100', 'currency'=>'INR', 'notes'=> array('branch'=>'Acme Corp Bangalore North', 'name'=>'Gaurav Kumar'), 'linked_account_notes'=>array('branch'), 'on_hold'=>'1', 'on_hold_until'=>'1671222870')));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |
| amount*   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |
| currency*   | string  | The currency of the payment (defaults to INR)  |
|  receipt      | string      | A unique identifier provided by you for your internal reference. |
| transfers   | array     | All parameters listed [here](https://razorpay.com/docs/api/route/#create-transfers-from-orders) are supported |

-------------------------------------------------------------------------------------------------------

### Direct transfers

```php
$api->transfer->create(array('account' => $accountId, 'amount' => 500, 'currency' => 'INR'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| accountId*   | string      | The id of the account to be fetched  |
| amount*   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |
| currency*   | string  | The currency of the payment (defaults to INR)  |

-------------------------------------------------------------------------------------------------------

### Fetch transfer payment

```php
$api->payment->fetch($paymentId)->transfer();
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |

-------------------------------------------------------------------------------------------------------

### Fetch transfer for an order

```php
$api->order->fetch($orderId)->transfers(array('expand[]'=>'transfers'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| orderId*   | string      | The id of the order to be fetched  |
| expand*   | string    | Supported value is `transfer`  |

-------------------------------------------------------------------------------------------------------

### Fetch transfer

```php
$api->transfer->fetch($transferId);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| transferId*   | string      | The id of the transfer to be fetched  |

-------------------------------------------------------------------------------------------------------

### Fetch transfers for a settlement

```php
$api->transfer->all(array('recipient_settlement_id'=> $recipientSettlementId));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| recipientSettlementId*   | string    | The recipient settlement id obtained from the settlement.processed webhook payload.  |

-------------------------------------------------------------------------------------------------------

### Fetch settlement details

```php
$api->transfer->all(array('expand[]'=> 'recipient_settlement'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| expand*   | string    | Supported value is `recipient_settlement`  |

-------------------------------------------------------------------------------------------------------

### Refund payments and reverse transfer from a linked account

```php
$api->payment->fetch($paymentId)->refund(array('amount'=> '100','reverse_all'=>'1'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |
| amount*   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |
| reverse_all   | boolean    | Reverses transfer made to a linked account. Possible values:<br> * `1` - Reverses transfer made to a linked account.<br>* `0` - Does not reverse transfer made to a linked account.|

-------------------------------------------------------------------------------------------------------

### Fetch payments of a linked account

```php
$api->payment->all(array('X-Razorpay-Account'=> $linkedAccountId));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| X-Razorpay-Account   | string      | The linked account id to fetch the payments received by linked account |

-------------------------------------------------------------------------------------------------------

### Reverse transfers from all linked accounts
```php
$api->transfer->fetch($transferId)->reverse(array('amount'=>'100'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| transferId*   | string      | The id of the transfer to be fetched  |
| amount   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |

-------------------------------------------------------------------------------------------------------

### Hold settlements for transfers
```php
$api->payment->fetch($paymentId)->transfer(array('account' => $accountId, 'amount' => 500, 'currency' => 'INR','on_hold'=>'1'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |
| transfers   | array     | All parameters listed here https://razorpay.com/docs/api/route/#hold-settlements-for-transfers are supported |

-------------------------------------------------------------------------------------------------------

### Modify settlement hold for transfers
```php
$api->transfer->fetch($paymentId)->edit(array('on_hold' => '1', 'on_hold_until' => '1679691505'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |
| transfers   | array     | All parameters listed here https://razorpay.com/docs/api/route/#hold-settlements-for-transfers are supported |

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/route/#transfers/)**
