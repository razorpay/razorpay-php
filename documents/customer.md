## Customer

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
| notes         | object      | A key-value pair                            |

-------------------------------------------------------------------------------------------------------
### Edit a customer
```php
$api->customer->fetch($customerId)->edit(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com','notes'=> array('notes_key_1'=> 'Tea, Earl Grey, Hot','notes_key_2'=> 'Tea, Earl Grey… decaf')));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*          | string      | The id of the customer to be updated  |
| email        | string      | Email of the customer                       |
| contact      | string      | Contact number of the customer              |
| notes         | object      | A key-value pair                            |

-------------------------------------------------------------------------------------------------------

### Fetch a customer
```php
$api->customer->fetch($customerId)
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*          | string      | The id of the customer to be fetched  |

-------------------------------------------------------------------------------------------------------

### Create a Fund Account
```php
$api->fundAccount->create(array('customer_id'=>$customerId,'account_type'=>'bank_account','bank_account'=>array('name'=>'Gaurav Kumar', 'account_number'=>'11214311215411', 'ifsc'=>'HDFC0000053')))
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*   | string      | The id of the customer to be fetched  |
| account_type* | string      | The bank_account to be linked to the customer ID  |
| bank_account* | object      | A key-value pair  |

-------------------------------------------------------------------------------------------------------

### Fetch All Fund Accounts
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
**For reference click [here](https://razorpay.com/docs/api/customers/)**

