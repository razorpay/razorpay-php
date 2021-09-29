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
| notes         | array      | A key-value pair                            |

-------------------------------------------------------------------------------------------------------
### Edit customer
```php
$api->customer->fetch($customerId)->edit(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com','notes'=> array('notes_key_1'=> 'Tea, Earl Grey, Hot','notes_key_2'=> 'Tea, Earl Grey… decaf')));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| customerId*          | string      | The id of the customer to be updated  |
| email        | string      | Email of the customer                       |
| contact      | string      | Contact number of the customer              |
| notes         | array      | A key-value pair                            |

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

[API Response](entityResponse.md#customer-api-response)

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/customers/)**
