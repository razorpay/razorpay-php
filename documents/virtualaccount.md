## Virtual account

### Create a virtual account
```php
$api->virtualAccount->create(array('receivers' => array('types'=> arra('bank_account')),'allowed_payers' => array(array('type'=>'bank_account','bank_account'=>array('ifsc'=>'RATN0VAAPIS','account_number'=>'2223330027558515'))),'description' => 'Virtual Account created for Raftar Soft','customer_id' => 'cust_HssUOFiOd2b1TJ', 'notes' => array('project_name' => 'Banking Software')));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| receivers*    | array      | Array that defines what receivers are available for this Virtual Account                        |
| allowed_payers*  | array      | All keys listed here https://razorpay.com/docs/api/smart-collect-tpv/#create-virtual-account are supported                    |

-------------------------------------------------------------------------------------------------------

### Fetch virtual account by id
```php
$api->virtualAccount->fetch($virtualId);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| virtualId*          | string      | The id of the virtual to be updated  |

-------------------------------------------------------------------------------------------------------

### Fetch all virtual account
```php
$api->virtualAccount->all($options);
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch payments for a virtual account
```php
$api->virtualAccount->fetch($virtualId)->payments($options);;
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| virtualId*  | string    | The id of the virtual to be updated  |
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch payment details using id and transfer method
```php
$api->payment->fetch($virtualId)->bankTransfer();
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| virtualId*  | string    | The id of the virtual to be updated  |

-------------------------------------------------------------------------------------------------------

### Add receiver to an existing virtual account
```php
$api->virtualAccount->fetch($virtualId)->addReceiver(array('types' => array('vpa'),'vpa' => array('descriptor'=>'gauravkumar')));
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| virtualId*  | string    | The id of the virtual to be updated  |
| types*  | array | The receiver type to be added to the virtual account. Possible values are `vpa` or `bank_account`  |
| vpa    | array | This is to be passed only when `vpa` is passed as the receiver types. |


-------------------------------------------------------------------------------------------------------

### Close virtual account
```php
$api->virtualAccount->fetch($virtualId)->close();
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| virtualId*  | string    | The id of the virtual to be updated  |

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/smart-collect/)**
