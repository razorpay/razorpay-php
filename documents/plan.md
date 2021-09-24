## Plans

### Create plan

```php
$api->plan->create(array('period' => 'weekly', 'interval' => 1, 'item' => array('name' => 'Test Weekly 1 plan', 'description' => 'Description for the weekly 1 plan', 'amount' => 600, 'currency' => 'INR'),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| period*          | string | Used together with `interval` to define how often the customer should be charged  |
| interval*          | string | Used together with `period` to define how often the customer should be charged  |
| items*          | array | Details of the plan. For more details please refer [here](https://razorpay.com/docs/api/subscriptions/#create-a-plan) |
| notes          | array | Notes you can enter for the contact for future reference.   |
-------------------------------------------------------------------------------------------------------

### Fetch all plans

```php
$api->plan->all();
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch particular plan

```php
$api->plan->fetch($planId);
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| planId  | string | The id of the plan to be fetched  |

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/subscriptions/#plans)**
