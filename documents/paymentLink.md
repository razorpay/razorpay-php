## Payment Links

### Create Payment Link

Request #1 
Standard Payment Link

```php
$api->payment_link->create(array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 
'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 
'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,
'reminder_enable'=>true ,'notes'=>array('policy_name'=> 'Jeevan Bima'),'callback_url' => 'https://example-callback-url.com/',
'callback_method'=>'get'));
```

Request #2
UPI Payment Link

```php
$api->payment_link->create(array('upi_link'=>true,'amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 
'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 
'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,
'reminder_enable'=>true ,'notes'=>array('policy_name'=> 'Jeevan Bima')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|upi_link*          | boolean | boolean Must be set to true   //   to creating UPI Payment Link only                                     |
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|currency           | string  |  A three-letter ISO code for the currency in which you want to accept the payment. For example, INR.                     |
|description           | string  | A brief description of the Payment Link                     |
|reference_id           | string  | AReference number tagged to a Payment Link.                      |
|customer           | array  | name, email, contact                 |
|expire_by           | integer  | Timestamp, in Unix, at which the Payment Link will expire. By default, a Payment Link will be valid for six months from the date of creation.                     |
|notify           | object  | sms or email (boolean)                     |
|notes           | json object  | Key-value pair that can be used to store additional information about the entity. Maximum 15 key-value pairs, 256 characters (maximum) each. For example, "note_key": "Beam me up Scotty”                     |
-------------------------------------------------------------------------------------------------------

### Fetch all Payemnt Link

```php
$api->paymentLink->all();
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|payment_id          | string | Unique identifier of the payment associated with the Payment Link.                                               |
|reference_id        | string  | The unique reference number entered by you while creating the Payment Link.                     |
                     

-------------------------------------------------------------------------------------------------------

### Fetch Payemnt Link

```php
$api->paymentLink->fetch($paymentLink_id);
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| paymentLink_id*          | string |  Unique identifier of the Payment Link.                         |
-------------------------------------------------------------------------------------------------------

### Update Payemnt Link

```php
$api->paymentLink->fetch($paymentLink_id)->edit(array("reference_id"=>"TS42", "expire_by"=>"1640270451" , "reminder_enable"=>0, "notes"=>["policy_name"=>"Jeevan Saral 2"]));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| paymentLink_id*          | string | The unique identifier of the Payment Link that needs to be updated.                         |
| accept_partial         | boolean | Indicates whether customers can make partial payments using the Payment Link. Possible values: true - Customer can make partial payments. false (default) - Customer cannot make partial payments.                         |
| reference_id          | string | Adds a unique reference number to an existing link.                         |
| expire_by         | integer | Timestamp, in Unix format, when the payment links should expire.                         |
| notes          | string | object Key-value pair that can be used to store additional information about the entity. Maximum 15 key-value pairs, 256 characters (maximum) each. For example, "note_key": "Beam me up Scotty”.                         |


-------------------------------------------------------------------------------------------------------

### Cancel a Payment Link

```php
$api->paymentLink->fetch($paymentLink_id)->cancel();
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| paymentLink_id*          | string | Unique identifier of the Payment Link.                         |
-------------------------------------------------------------------------------------------------------

### Send notification

```php
$api->paymentLink->fetch($paymentLink_id)->notifyBy($medium));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| paymentLink_id*          | string | Unique identifier of the Payment Link that should be resent.                         |
| medium*          | string | `sms`/`email`,Medium through which the Payment Link must be resent. Allowed values are:           |
-------------------------------------------------------------------------------------------------------

### Transfer Payments Received Using Payment Links

```php
$api->payment_link->create(array('amount'=>20000, 'currency'=>'INR', 'accept_partial'=>false, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('order'=>array('transfers'=>array('account'=>'acc_CPRsN1LkFccllA', 'amount'=>500, 'currency'=>'INR', 'notes'=>array('branch'=>'Acme Corp Bangalore North', 'name'=>'Bhairav Kumar' ,'linked_account_notes'=>array('branch'))), array('account'=>'acc_CNo3jSI8OkFJJJ', 'amount'=>500, 'currency'=>'INR', 'notes'=>array('branch'=>'Acme Corp Bangalore North', 'name'=>'Saurav Kumar' ,'linked_account_notes'=>array('branch')))))));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|options*           | array  |  Options to configure the transfer in the Payment Link. Parent parameter under which the order child parameter must be passed.                     |

-------------------------------------------------------------------------------------------------------

### Offers on Payment Links

```php
$api->payment_link->create(array('amount'=>20000, 'currency'=>'INR', 'accept_partial'=>false, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>false , 'options'=>array('order'=>array('offers'=>array('offer_I0PqexIiTmMRnA'))));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|currency           | string  |  A three-letter ISO code for the currency in which you want to accept the payment. For example, INR.                     |
|description           | string  | A brief description of the Payment Link                     |
|reference_id           | string  | AReference number tagged to a Payment Link.                      |
|customer           | array  | name, email, contact                 |
|expire_by           | integer  | Timestamp, in Unix, at which the Payment Link will expire. By default, a Payment Link will be valid for six months from the date of creation.                     |
|notify           | object  | sms or email (boolean)                     |
|options*        | array  | Options to associate the offer_id with the Payment Link. Parent parameter under which the order child parameter must be passed.                     |

-------------------------------------------------------------------------------------------------------

### Managing Reminders for Payment Links

```php
$api->payment_link->create(array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>false));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|accept_partial        | boolean  |  Indicates whether customers can make partial payments using the Payment Link. Possible values:true - Customer can make partial payments.false (default) - Customer cannot make partial payments.                     |
|currency           | string  |  A three-letter ISO code for the currency in which you want to accept the payment. For example, INR.                     |
|description           | string  | A brief description of the Payment Link                     |
|customer           | array  | name, email, contact                 |
|expire_by           | integer  | Timestamp, in Unix, at which the Payment Link will expire. By default, a Payment Link will be valid for six months from the date of creation.                     |
|notify           | object  | sms or email (boolean)                     |
|reminder_enable       | boolean  | To disable reminders for a Payment Link, pass reminder_enable as false                     |

-------------------------------------------------------------------------------------------------------

### Rename Labels in Checkout Section

```php
$api->payment_link->create(array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('partial_payment'=>array('min_amount_label'=>'Minimum Money to be paid', 'partial_amount_label'=>'Pay in parts', 'partial_amount_description'=>'Pay at least ₹100', 'full_amount_label'=>'Pay the entire amount')))));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|accept_partial        | boolean  |  Indicates whether customers can make partial payments using the Payment Link. Possible values:true - Customer can make partial payments.false (default) - Customer cannot make partial payments.                     |
|currency           | string  |  A three-letter ISO code for the currency in which you want to accept the payment. For example, INR.                     |
|description           | string  | A brief description of the Payment Link                     |
|customer           | array  | name, email, contact                 |
|expire_by           | integer  | Timestamp, in Unix, at which the Payment Link will expire. By default, a Payment Link will be valid for six months from the date of creation.                     |
|notify           | object  | sms or email (boolean)                     |
|reminder_enable       | boolean  | To disable reminders for a Payment Link, pass reminder_enable as false                     |
|options*       | array  | Options to rename the labels for partial payment fields in the checkout form. Parent parameter under which the checkout and partial_payment child parameters must be passed. 
-------------------------------------------------------------------------------------------------------

### Change Business Name

```php
$api->payment_link->create(array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('name'=>'Lacme Corp'))));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|currency           | string  |  A three-letter ISO code for the currency in which you want to accept the payment. For example, INR.                     |
|accept_partial        | boolean  |  Indicates whether customers can make partial payments using the Payment Link. Possible values:true - Customer can make partial payments.false (default) - Customer cannot make partial payments.                     |
|first_min_partial_amount        | integer  |                      |
|description           | string  | A brief description of the Payment Link                     |
|customer           | array  | name, email, contact                 |
|notify           | object  | sms or email (boolean)                     |
|reminder_enable       | boolean  | To disable reminders for a Payment Link, pass reminder_enable as false                     |
|options*       | array  | Option to customize the business name. Parent parameter under which the checkout child parameter must be passed.| 
-------------------------------------------------------------------------------------------------------

### Prefill Checkout Fields

```php
$api->payment_link->create(array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('prefill'=>array('method'=>'card', 'card[name]'=>'Gaurav Kumar', 'card[number]'=>'4111111111111111', 'card[expiry]'=>'12/21', 'card[cvv]'=>'123')))));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|currency           | string  |  A three-letter ISO code for the currency in which you want to accept the payment. For example, INR.                     |
|accept_partial        | boolean  |  Indicates whether customers can make partial payments using the Payment Link. Possible values:true - Customer can make partial payments.false (default) - Customer cannot make partial payments.                     |
|first_min_partial_amount        | integer  |                      |
|description           | string  | A brief description of the Payment Link                     |
|customer           | array  | name, email, contact                 |
|notify           | object  | sms or email (boolean)                     |
|reminder_enable       | boolean  | To disable reminders for a Payment Link, pass reminder_enable as false                     |
|options*       | array  | Options to customize Checkout. Parent parameter under which the checkout and prefill child parameters must be passed.| 
-------------------------------------------------------------------------------------------------------

### Customize Payment Methods

```php
$api->payment_link->create(array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('method'=>array('netbanking'=>'1', 'card'=>'1', 'upi'=>'0', 'wallet'=>'0')))));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|currency           | string  |  A three-letter ISO code for the currency in which you want to accept the payment. For example, INR.                     |
|accept_partial        | boolean  |  Indicates whether customers can make partial payments using the Payment Link. Possible values:true - Customer can make partial payments.false (default) - Customer cannot make partial payments.                     |
|first_min_partial_amount        | integer  |                      |
|description           | string  | A brief description of the Payment Link                     |
|customer           | array  | name, email, contact                 |
|notify           | object  | sms or email (boolean)                     |
|reminder_enable       | boolean  | To disable reminders for a Payment Link, pass reminder_enable as false                     |
|options*       | array  | Options to display or hide payment methods on the Checkout section. Parent parameter under which the checkout and method child parameters must be passed.| 
-------------------------------------------------------------------------------------------------------

### Set Checkout Fields as Read-Only

```php
$api->payment_link->create(array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('readonly'=>array('email'=>'1','contact'=>'1')))));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|currency           | string  |  A three-letter ISO code for the currency in which you want to accept the payment. For example, INR.                     |
|accept_partial        | boolean  |  Indicates whether customers can make partial payments using the Payment Link. Possible values:true - Customer can make partial payments.false (default) - Customer cannot make partial payments.                     |
|first_min_partial_amount        | integer  |                      |
|description           | string  | A brief description of the Payment Link                     |
|customer           | array  | name, email, contact                 |
|notify           | object  | sms or email (boolean)                     |
|reminder_enable       | boolean  | To disable reminders for a Payment Link, pass reminder_enable as false                     |
|options*       | array  | Options to set contact and email as read-only fields on Checkout. Parent parameter under which the checkout and readonly child parameters must be passed.| 
-------------------------------------------------------------------------------------------------------

### Implement Thematic Changes in Payment Links Checkout Section

```php
$api->payment_link->create(array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('checkout'=>array('theme'=>array('hide_topbar'=>'true')))));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|currency           | string  |  A three-letter ISO code for the currency in which you want to accept the payment. For example, INR.                     |
|accept_partial        | boolean  |  Indicates whether customers can make partial payments using the Payment Link. Possible values:true - Customer can make partial payments.false (default) - Customer cannot make partial payments.                     |
|first_min_partial_amount        | integer  |                      |
|description           | string  | A brief description of the Payment Link                     |
|customer           | array  | name, email, contact                 |
|notify           | object  | sms or email (boolean)                     |
|reminder_enable       | boolean  | To disable reminders for a Payment Link, pass reminder_enable as false                     |
|options*       | array  | Options to show or hide the top bar. Parent parameter under which the checkout and theme child parameters must be passed.| 
-------------------------------------------------------------------------------------------------------


### Rename Labels in Payment Details Section

```php
$api->payment_link->create(array('amount'=>500, 'currency'=>'INR', 'accept_partial'=>true, 'first_min_partial_amount'=>100, 'description' => 'For XYZ purpose', 'customer' => array('name'=>'Gaurav Kumar', 'email' => 'gaurav.kumar@example.com', 'contact'=>'+919999999999'),  'notify'=>array('sms'=>true, 'email'=>true) ,'reminder_enable'=>true , 'options'=>array('hosted_page'=>array('label'=>array('receipt'=>'Ref No.', 'description'=>'Course Name', 'amount_payable'=>'Course Fee Payable', 'amount_paid'=>'Course Fee Paid', 'partial_amount_due'=>'Fee Installment Due', 'partial_amount_paid'=>'Fee Installment Paid', 'expire_by'=>'Pay Before', 'expired_on'=>'1632223497','amount_due'=>'Course Fee Due'), 'show_preferences'=>array('issued_to'=>false)))));

```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
|amount*        | integer  | Amount to be paid using the Payment Link.                     |
|currency           | string  |  A three-letter ISO code for the currency in which you want to accept the payment. For example, INR.                     |
|accept_partial        | boolean  |  Indicates whether customers can make partial payments using the Payment Link. Possible values:true - Customer can make partial payments.false (default) - Customer cannot make partial payments.                     |
|first_min_partial_amount        | integer  |                      |
|description           | string  | A brief description of the Payment Link                     |
|customer           | array  | name, email, contact                 |
|notify           | object  | sms or email (boolean)                     |
|reminder_enable       | boolean  | To disable reminders for a Payment Link, pass reminder_enable as false                     |
|options*       | array  | Parent parameter under which the hosted_page and label child parameters must be passed.| 
-------------------------------------------------------------------------------------------------------




**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/payment-links/)**
