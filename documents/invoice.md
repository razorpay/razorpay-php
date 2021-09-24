## Invoices

### Create Invoice

Request #1
In this example, an invoice is created using the customer and item details. Here, the customer and item are created while creating the invoice.
```php
$api->order->create(array ('type' => 'invoice','description' => 'Invoice for the month of January 2020','partial_payment' => true,'customer' =>array ('name' => 'Gaurav Kumar','contact' => 9999999999,'email' => 'gaurav.kumar@example.com','billing_address' => array ('line1' => 'Ground & 1st Floor, SJR Cyber Laskar','line2' => 'Hosur Road','zipcode' => '560068','city' => 'Bengaluru','state' => 'Karnataka','country' => 'in'),'shipping_address' => array ('line1' => 'Ground & 1st Floor, SJR Cyber Laskar','line2' => 'Hosur Road','zipcode' => '560068','city' => 'Bengaluru','state' => 'Karnataka','country' => 'in')),'line_items' => array (array ('name' => 'Master Cloud Computing in 30 Days','description' => 'Book by Ravena Ravenclaw','amount' => 399,'currency' => 'USD','quantity' => 1)),'sms_notify' => 1,'email_notify' => 1,'currency' => 'USD','expire_by' => 1589765167));
```

Request #2
In this example, an invoice is created using existing `customer_id` and `item_id`
```php
$api->invoice->create(array ('type' => 'invoice','date' => 1589994898, 'customer_id'=> 'cust_E7q0trFqXgExmT', 'line_items'=>array(array('item_id'=>'item_DRt61i2NnL8oy6'))));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|type*          | string | entity type (here its invoice)                                               |
|description        | string  | A brief description of the invoice.                      |
|customer_id           | string  | customer id for which invoice need be raised                     |
|customer           | array  | customer details in a array format                     |

-------------------------------------------------------------------------------------------------------

### Fetch all invoices

```php
$api->invoice->all();
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|type          | string | entity type (here its invoice)                                               |
|payment_id        | string  | The unique identifier of the payment made by the customer against the invoice.                      |
|customer_id           | string  | The unique identifier of the customer.                     |
|receipt           | string  |  The unique receipt number that you entered for internal purposes.                     |

-------------------------------------------------------------------------------------------------------

### Fetch invoice

```php
$api->invoice->fetch($invoiceId);
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*          | string | The id of the invoice to be fetched                         |
-------------------------------------------------------------------------------------------------------

### Update invoice

```php
$api->invoice->fetch($invoiceId)->edit(array('line_items' => array(array('id' => 'li_DAweOizsysoJU6','name' => 'Book / English August - Updated name and quantity','quantity' => 1),array('name' => 'Book / A Wild Sheep Chase','amount' => 200,'currency' => 'INR','quantity' => 1)),'notes' => array('updated-key' => 'An updated note.')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*          | string | The id of the invoice to be fetched                         |
-------------------------------------------------------------------------------------------------------

### Issue an invoice

```php
$api->invoice->fetch($invoiceId)->issue();
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*          | string | The id of the invoice to be issued                         |
-------------------------------------------------------------------------------------------------------

### Delete an invoice

```php
$api->invoice->fetch($invoiceId)->delete();
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*          | string | The id of the invoice to be deleted                         |
-------------------------------------------------------------------------------------------------------

### Cancel an invoice

```php
$api->invoice->fetch($invoiceId)->cancel();
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*          | string | The id of the invoice to be cancelled                         |
-------------------------------------------------------------------------------------------------------

### Send notification

```php
$api->invoice->fetch($invoiceId)->notify($medium);
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| invoiceId*          | string | The id of the invoice to be notified                         |
| medium*          | string | `sms`/`email`, Medium through which notification should be sent.                         |
-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/invoices)**
