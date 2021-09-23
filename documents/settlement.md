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
| count | integer   | number of settlements to fetch (default: 10)        |
| skip  | integer   | number of settlements to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/settlements/)**
