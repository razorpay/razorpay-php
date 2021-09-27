## Subscriptions

### Create subscription

```php
$api->subscription->create(array('plan_id' => 'plan_7wAosPWtrkhqZw', 'customer_notify' => 1,'quantity'=>5, 'total_count' => 6, 'start_at' => 1495995837, 'addons' => array(array('item' => array('name' => 'Delivery charges', 'amount' => 30000, 'currency' => 'INR'))),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| plan_id*          | string | The unique identifier for a plan that should be linked to the subscription.|
| total_count*   | string | The number of billing cycles for which the customer should be charged  |
| customer_notify    | boolean | Indicates whether the communication to the customer would be handled by you or us |
| quantity    | integer | The number of times the customer should be charged the plan amount per invoice |
| start_at    | integer | The timestamp, in Unix format, for when the subscription should start. If not passed, the subscription starts immediately after the authorization payment. |
| expire_by    | integer | The timestamp, in Unix format, till when the customer can make the authorization payment. |
| addons    | array | Array that contains details of any upfront amount you want to collect as part of the authorization transaction. |
| notes          | array | Notes you can enter for the contact for future reference.   |
-------------------------------------------------------------------------------------------------------

### Create subscription link

```php
$api->subscription->create(array('plan_id' => 'plan_HoYg68p5kmuvzD','total_count' => 12,'quantity' => 1,'expire_by' => 1633237807,'customer_notify' => 1, 'addons' => array(array('item'=>array('name' => 'Delivery charges','amount' => 30000,'currency' => 'INR'))),'notes'=>array('notes_key_1'=>'Tea, Earl Grey, Hot','notes_key_2'=>'Tea, Earl Grey… decaf.'),'notify_info'=>array('notify_phone' => '9123456789','notify_email'=> 'gaurav.kumar@example.com')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| plan_id*          | string | The unique identifier for a plan that should be linked to the subscription.|
| total_count*   | string | The number of billing cycles for which the customer should be charged  |
| customer_notify    | boolean | Indicates whether the communication to the customer would be handled by you or us |
| quantity    | integer | The number of times the customer should be charged the plan amount per invoice |
| start_at    | integer | The timestamp, in Unix format, for when the subscription should start. If not passed, the subscription starts immediately after the authorization payment. |
| expire_by    | integer | The timestamp, in Unix format, till when the customer can make the authorization payment. |
| addons    | array | Array that contains details of any upfront amount you want to collect as part of the authorization transaction. |
| notes          | array | Notes you can enter for the contact for future reference.   |
| notify_info          | array | The customer's email and phone number to which notifications are to be sent. (PN: Use this array only if you have set the `customer_notify` parameter to 1. That is, Razorpay sends notifications to the customer.)  |
-------------------------------------------------------------------------------------------------------

### Fetch all subscriptions

```php
$api->subscription->all();
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |
| plan_id  | string   | The unique identifier of the plan for which you want to retrieve all the subscriptions    |

-------------------------------------------------------------------------------------------------------

### Fetch particular subscription

```php
$api->subscription->fetch($subscriptionId);
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | string | The id of the subscription to be fetched  |

-------------------------------------------------------------------------------------------------------

### Cancel particular subscription

```php
$api->subscription->fetch($subscriptionId)->cancel($options);
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | string | The id of the subscription to be cancelled  |
| cancel_at_cycle_end  | boolean | Possible values:<br>0 (default): Cancel the subscription immediately. <br> 1: Cancel the subscription at the end of the current billing cycle.  |

-------------------------------------------------------------------------------------------------------

### Update particular subscription

```php
$api->subscription->fetch($subscriptionId)->update($options);
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | string | The id of the subscription to be updated  |
| options  | array | All parameters listed [here](https://razorpay.com/docs/api/subscriptions/#update-a-subscription) for update   |

-------------------------------------------------------------------------------------------------------

### Fetch details of pending update

```php
$api->subscription->fetch($subscriptionId)->pendingUpdate()
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | string | The id of the subscription to fetch pending update  |

-------------------------------------------------------------------------------------------------------

### Cancel a update

```php
$api->subscription->fetch($subscriptionId)->cancelAtNextCycle();
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | string | The id of the subscription to be cancel an update  |

-------------------------------------------------------------------------------------------------------

### Pause a subscription

```php
$api->subscription->fetch($subscriptionId)->pause(array('pause_at'=>'now'))
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | string | The id of the subscription to be paused  |
| pause_at  | string | To pause the subscription, possible values: `now`  |

-------------------------------------------------------------------------------------------------------

### Resume a subscription

```php
$api->subscription->fetch($subscriptionId)->resume(array('resume_at'=>'now'))
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | string | The id of the subscription to be resumed  |
| resume_at  | string | To resume the subscription, possible values: `now`  |

-------------------------------------------------------------------------------------------------------

### Fetch all invoices for a subscription

```php
$api->invoice->all(['subscription_id'=>$subscriptionId]);
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | string | The id of the subscription to fetch invoices  |

-------------------------------------------------------------------------------------------------------

### Delete offer link to a subscription

```php
$api->subscription->fetch($subscriptionId)->offer($offerId)
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | string | The id of the subscription to offer need to be deleted  |
| offerId*  | string | The id of the offer linked to subscription  |

-------------------------------------------------------------------------------------------------------

### Authentication payment

please refer this [doc](https://razorpay.com/docs/api/subscriptions/#authentication-transaction) for authentication of transaction

-------------------------------------------------------------------------------------------------------

### Payment verification

```php
$api->utility->verifyPaymentSignature($options)
```

please refer this [doc](https://razorpay.com/docs/api/subscriptions/#payment-verification) for payment verification

-------------------------------------------------------------------------------------------------------

### Create addon

```php
$api->subscription->fetch($subscriptionId)->createAddon(array('item' => array('name' => 'Extra Chair', 'amount' => 30000, 'currency' => 'INR'), 'quantity' => 2))
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | boolean | The subscription ID to which the add-on is being added. |
| items*  | array | Details of the add-on you want to create. |
| quantity*  | integer | This specifies the number of units of the add-on to be charged to the customer. |

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/subscriptions/#subscriptions)**
