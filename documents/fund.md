## Funds

### Create a fund account
```php
$api->fundAccount->create(array('customer_id'=>$customerId,'account_type'=>'bank_account','bank_account'=>array('name'=>'Gaurav Kumar', 'account_number'=>'11214311215411', 'ifsc'=>'HDFC0000053')))
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*   | string      | The id of the customer to be fetched  |
| account_type* | string      | The bank_account to be linked to the customer ID  |
| bank_account* | array      | A key-value pair  |

-------------------------------------------------------------------------------------------------------

### Fetch all fund accounts
```php
$api->fundAccount->all(array('customer_id'=>$customerIds));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*   | string      | The id of the customer to be fetched  |

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/payments/customers/customer-fund-account-api/)**