## Settlements

### Fetch all  settlements

```php
$api->settlement->all($options);
```

**Parameters:**


| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| from  | timestamp | timestamp after which the settlement were created  |
| to    | timestamp | timestamp before which the settlement were created |
| count | integer   | number of settlements to fetch (default: 10)        |
| skip  | integer   | number of settlements to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch a settlement

```php
$api->settlement->fetch($settlementId);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| $settlementId* | string      | The id of the settlement to be fetched  |

-------------------------------------------------------------------------------------------------------

### Settlement report for a month

```php
$api->settlement->reports(array("year"=>2020,"month"=>09));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| year* | integer      | The year the settlement was received in the `YYYY` format. For example, `2020`   |
| month* | integer      | The month the settlement was received in the `MM` format. For example, `09`   |
| day | integer      | The date the settlement was received in the `DD` format. For example, `01`   |
| count | integer   | number of settlements to fetch (default: 10)        |
| skip  | integer   | number of settlements to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Create on-demand Settlement

```php
$api->settlement->createOndemandSettlement(array("amount"=> 1221, "settle_full_balance"=> false, "description"=>"Testing","notes" => array("notes_key_1"=> "Tea, Earl Grey, Hot","notes_key_2"=> "Tea, Earl Grey… decaf.")));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| amount*| integer      | Maximum amount that can be settled  |
| settle_full_balance* | boolean      | true or false   |
| description | string   | The description may not be greater than 30 characters    |
| notes   | array   | A key-value pair     |

-------------------------------------------------------------------------------------------------------

### Settlement Recon

```php
$api->settlement->settlementRecon(array('year' => 2018, 'month' => 2, 'day'=>11));

```

**Parameters:**

|
| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| year* | integer      | The year the settlement was received in the `YYYY` format. For example, `2020`   |
| month* | integer      | The month the settlement was received in the `MM` format. For example, `09`   |
| day | integer   | The day the settlement was received in the `DD` format. For example,      |


-------------------------------------------------------------------------------------------------------

### Fetch All On-demand Settlements

```php

$api->settlement->fetchAllOndemandSettlement($options);

```
**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch On-demand Settlement by ID

```php
$api->settlement->fetchOndemandSettlementById($settlementId);

```

**Parameters:**

| Name       | Type   | Description                       |
|------------|--------|-----------------------------------|
| $settlementId* | string | Settlement Id of the On-demand settlement|

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/settlements/)**
