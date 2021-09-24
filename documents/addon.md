## Addons

### Create an addon

Please refer `create addon` in [subscription](addon.md)

-------------------------------------------------------------------------------------------------------

### Fetch all addons

```php
$api->addon->all($options);
```

**Parameters:**

| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch an addon

```php
$api->addon->fetch($addonId);
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| addonId*          | string | addon id to be fetched                                               |

-------------------------------------------------------------------------------------------------------

### Delete an addon

```php
$api->addon->fetch($addonId)->delete();
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| addonId*          | string | addon id to be deleted |

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/subscriptions/#add-ons)**
