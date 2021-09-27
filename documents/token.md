## Tokens

### Fetch token by payment id
```php
$api->payment->fetch($paymentId);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*    | string      | The id of the payment to be fetched |

-------------------------------------------------------------------------------------------------------

### Fetch tokens by customer id
```php
$api->customer->fetch($customerId)->tokens()->all();
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*          | string      | The id of the customer to be fetched |

-------------------------------------------------------------------------------------------------------

### Fetch particular token
```php
$api->customer->fetch($customerId)->tokens()->fetch($tokenId);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*          | string      | The id of the customer to be fetched |
| tokenId*          | string      | The id of the token to be fetched |

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

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/recurring-payments/upi/tokens/)**
