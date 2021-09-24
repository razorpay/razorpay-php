## Qr Codes

### Create Qr code

```php
$api->qrCode->create(array("type" => "upi_qr","name" => "Store_1", "usage" => "single_use","fixed_amount" => 1,"payment_amount" => 300,"customer_id" => "cust_HKsR5se84c5LTO","description" => "For Store 1","close_by" => 1681615838,"notes" => array("purpose" => "Test UPI QR code notes")));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| type*          | string | The type of QR code i.e, `upi_qr`/`bharat_qr`                                  |
| name          | string | Label entered to identify the QR code.                              |
| usage*          | string | Indicates if the QR code should be allowed to accept single payment or multiple payments i.e, `single_use`/`multiple_use`     |
| fixed_amount          | boolean | Indicates if the QR should accept payments of specific amounts or any amount. |
| payment_amount(* mandatory if fixed_amount is true)          | integer | Indicates if the QR should accept payments of specific amounts or any amount. |
| customer_id          | string | Unique identifier of the customer the QR code is linked with |
| description          | string | A brief description about the QR code. |
| close_by          | integer | UNIX timestamp at which the QR code is scheduled to be automatically closed. The time must be at least 15 minutes after the current time.  |
| notes          | array | Key-value pair that can be used to store additional information about the QR code. Maximum 15 key-value pairs, 256 characters (maximum) each. |

-------------------------------------------------------------------------------------------------------

### Create Qr code with GST

```php
$api->qrCode->create(array("type" => "upi_qr","name" => "Store_1", "usage" => "single_use","fixed_amount" => 1,"payment_amount" => 300,"customer_id" => "cust_HKsR5se84c5LTO","description" => "For Store 1","close_by" => 1681615838,"notes" => array("purpose" => "Test UPI QR code notes"),"tax_invoice" => array("number" => "INV001", "date" => 1589994898,"customer_name" => "Gaurav Kumar", "business_gstin"=> "06AABCU9605R1ZR","gst_amount" => 4000, "cess_amount" => 0, "supply_type" => "interstate")));
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| type*          | string | The type of QR code i.e, `upi_qr`/`bharat_qr`                                  |
| name          | string | Label entered to identify the QR code.                              |
| usage*          | string | Indicates if the QR code should be allowed to accept single payment or multiple payments i.e, `single_use`/`multiple_use`     |
| fixed_amount          | boolean | Indicates if the QR should accept payments of specific amounts or any amount. |
| payment_amount(* mandatory if fixed_amount is true)          | integer | Indicates if the QR should accept payments of specific amounts or any amount. |
| customer_id          | string | Unique identifier of the customer the QR code is linked with |
| description          | string | A brief description about the QR code. |
| close_by          | integer | UNIX timestamp at which the QR code is scheduled to be automatically closed. The time must be at least 15 minutes after the current time.  |
| notes          | array | Key-value pair that can be used to store additional information about the QR code. Maximum 15 key-value pairs, 256 characters (maximum) each. |
| tax_invoice          | array | This block contains information about the invoices. If not provided, the transaction will default to non-GST compliant UPI flow. |

-------------------------------------------------------------------------------------------------------

### Fetch all Qr code

```php
$api->qrCode->all($options)
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Fetch a Qr code

```php
$api->qrCode->fetch($qrCodeId)
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| qrCodeId  | string | The id of the qr code to be fetched  |

-------------------------------------------------------------------------------------------------------

### Fetch a Qr code for customer id

```php
 $api->qrCode->all(["customer_id" => $customerId])
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| customerId*  | string | The id of the customer to which qr code need to be fetched  |

-------------------------------------------------------------------------------------------------------

### Fetch a Qr code for payment id

```php
 $api->qrCode->all(["payment_id" => $paymentId])
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| paymentID*  | string | The id of the payment to which qr code need to be fetched  |

-------------------------------------------------------------------------------------------------------

### Fetch Payments for a QR Code

```php
$api->qrCode->fetch($qrCodeId)->fetchAllPayments($options)
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| qrCodeID*  | string | The id of the qr code to which payment where made |
| from  | timestamp | timestamp after which the payments were created  |
| to    | timestamp | timestamp before which the payments were created |
| count | integer   | number of payments to fetch (default: 10)        |
| skip  | integer   | number of payments to be skipped (default: 0)    |

-------------------------------------------------------------------------------------------------------

### Close a QR Code

```php
$api->qrCode->fetch($qrCodeId)->close()
```

**Parameters:**

| Name            | Type    | Description                                                                  |
|-----------------|---------|------------------------------------------------------------------------------|
| qrCodeID*  | string | The id of the qr code to be closed |

-------------------------------------------------------------------------------------------------------


**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/qr-codes/)**
