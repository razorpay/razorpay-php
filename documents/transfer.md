## Transfers

### Create transfers from payment

```php
$api->payment->fetch($paymentId)->transfer(array('transfers' => array(array('account' => 'acc_I0QRP7PpvaHhpB','amount' => 100,'currency' => 'INR','notes' =>  array ('name' => 'Gaurav Kumar','roll_no' => 'IEC2011025',),'linked_account_notes' => array ('roll_no'),'on_hold' => true,'on_hold_until' => 1671222870))));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |
| transfers   | array     | All parameters listed [here](https://razorpay.com/docs/api/route/#create-transfers-from-payments) are supported |

**Response:**
```json
{
  "entity": "collection",
  "count": 1,
  "items": [
    {
      "id": "trf_E9uhYLFLLZ2pks",
      "entity": "transfer",
      "source": "pay_E8JR8E0XyjUSZd",
      "recipient": "acc_CPRsN1LkFccllA",
      "amount": 100,
      "currency": "INR",
      "amount_reversed": 0,
      "notes": {
        "name": "Gaurav Kumar",
        "roll_no": "IEC2011025"
      },
      "on_hold": true,
      "on_hold_until": 1671222870,
      "recipient_settlement_id": null,
      "created_at": 1580218356,
      "linked_account_notes": [
        "roll_no"
      ],
      "processed_at": 1580218357
    }
  ]
}
```
-------------------------------------------------------------------------------------------------------

### Create transfers from order

```php
$api->order->create(array('amount' => 2000,'currency' => 'INR','transfers' => array(array('account' => 'acc_CPRsN1LkFccllA','amount' => 1000,'currency' => 'INR','notes' => array('branch' => 'Acme Corp Bangalore North','name' => 'Gaurav Kumar'),'linked_account_notes' => array('branch'),'on_hold' => 1,'on_hold_until' => 1671222870),array('account' => 'acc_CNo3jSI8OkFJJJ','amount' => 1000,'currency' => 'INR','notes' => array('branch' => 'Acme Corp Bangalore South','name' => 'Saurav Kumar'),'linked_account_notes' => array('branch'),'on_hold' => 0))));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| amount*   | integer      | The transaction amount, in paise |
| currency*   | string  | The currency of the payment (defaults to INR)  |
|  receipt      | string      | A unique identifier provided by you for your internal reference. |
| transfers   | array     | All parameters listed [here](https://razorpay.com/docs/api/route/#create-transfers-from-orders) are supported |

**Response:**
```json
{
  "id": "order_E9uTczH8uWPCyQ",
  "entity": "order",
  "amount": 2000,
  "amount_paid": 0,
  "amount_due": 2000,
  "currency": "INR",
  "receipt": null,
  "offer_id": null,
  "status": "created",
  "attempts": 0,
  "notes": [],
  "created_at": 1580217565,
  "transfers": [
    {
      "recipient": "acc_CPRsN1LkFccllA",
      "amount": 1000,
      "currency": "INR",
      "notes": {
        "branch": "Acme Corp Bangalore North",
        "name": "Gaurav Kumar"
      },
      "linked_account_notes": [
        "branch"
      ],
      "on_hold": true,
      "on_hold_until": 1671222870
    },
    {
      "recipient": "acc_CNo3jSI8OkFJJJ",
      "amount": 1000,
      "currency": "INR",
      "notes": {
        "branch": "Acme Corp Bangalore South",
        "name": "Saurav Kumar"
      },
      "linked_account_notes": [
        "branch"
      ],
      "on_hold": false,
      "on_hold_until": null
    }
  ]
}
```
-------------------------------------------------------------------------------------------------------

### Direct transfers

```php
$api->transfer->create(array('account' => $accountId, 'amount' => 500, 'currency' => 'INR'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| accountId*   | string      | The id of the account to be fetched  |
| amount*   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |
| currency*   | string  | The currency of the payment (defaults to INR)  |

**Response:**
```json
{
    "id": "trf_JhdmwXgQpEk38N",
    "entity": "transfer",
    "status": "processed",
    "source": "acc_HZbJUcl6DBDLIN",
    "recipient": "acc_HjVXbtpSCIxENR",
    "amount": 100,
    "currency": "INR",
    "amount_reversed": 0,
    "fees": 1,
    "tax": 0,
    "notes": [],
    "linked_account_notes": [],
    "on_hold": false,
    "on_hold_until": null,
    "recipient_settlement_id": null,
    "created_at": 1655267791,
    "processed_at": 1655267792,
    "error": {
        "code": null,
        "description": null,
        "reason": null,
        "field": null,
        "step": null,
        "id": "trf_JhdmwXgQpEk38N",
        "source": null,
        "metadata": null
    }
}
```
-------------------------------------------------------------------------------------------------------

### Fetch transfer for a payment

```php
$api->payment->fetch($paymentId)->transfers();
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |

**Response:**
```json
{
    "entity": "collection",
    "count": 1,
    "items": [
        {
            "id": "trf_JGQjgcy8zHFq7e",
            "entity": "transfer",
            "status": "partially_reversed",
            "source": "order_JGQjgaUikLJo8n",
            "recipient": "acc_HalyQGZh9ZyiGg",
            "amount": 500,
            "currency": "INR",
            "amount_reversed": 100,
            "fees": 1,
            "tax": 0,
            "notes": {
                "branch": "Acme Corp Bangalore South",
                "name": "Saurav Kumar"
            },
            "linked_account_notes": [
                "branch"
            ],
            "on_hold": true,
            "on_hold_until": 1679691505,
            "settlement_status": "on_hold",
            "recipient_settlement_id": null,
            "created_at": 1649326643,
            "processed_at": 1649326701,
            "error": {
                "code": null,
                "description": null,
                "reason": null,
                "field": null,
                "step": null,
                "id": "trf_JGQjgcy8zHFq7e",
                "source": null,
                "metadata": null
            }
        }
    ]
}
```
-------------------------------------------------------------------------------------------------------

### Fetch transfer for an order

```php
$api->order->fetch($orderId)->transfers(array('expand[]'=>'transfers'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| orderId*   | string      | The id of the order to be fetched  |
| expand*   | string    | Supported value is `transfer`  |

**Response:**
```json
{
    "id": "order_JfOO8JYmAtYRL0",
    "entity": "order",
    "amount": 2000,
    "amount_paid": 0,
    "amount_due": 2000,
    "currency": "INR",
    "receipt": null,
    "offer_id": "offer_JGQvQtvJmVDRIA",
    "offers": [
        "offer_JGQvQtvJmVDRIA"
    ],
    "status": "created",
    "attempts": 0,
    "notes": [],
    "created_at": 1654776878,
    "transfers": {
        "entity": "collection",
        "count": 2,
        "items": [
            {
                "id": "trf_JfOO8LGAPdwky4",
                "entity": "transfer",
                "status": "created",
                "source": "order_JfOO8JYmAtYRL0",
                "recipient": "acc_HjVXbtpSCIxENR",
                "amount": 1000,
                "currency": "INR",
                "amount_reversed": 0,
                "fees": 0,
                "tax": null,
                "notes": {
                    "branch": "Acme Corp Bangalore North",
                    "name": "Gaurav Kumar"
                },
                "linked_account_notes": [
                    "branch"
                ],
                "on_hold": true,
                "on_hold_until": 1671222870,
                "settlement_status": null,
                "recipient_settlement_id": null,
                "created_at": 1654776878,
                "processed_at": null,
                "error": {
                    "code": null,
                    "description": null,
                    "reason": null,
                    "field": null,
                    "step": null,
                    "id": "trf_JfOO8LGAPdwky4",
                    "source": null,
                    "metadata": null
                }
            },
            {
                "id": "trf_JfOO8M4p6tQZ6g",
                "entity": "transfer",
                "status": "created",
                "source": "order_JfOO8JYmAtYRL0",
                "recipient": "acc_HalyQGZh9ZyiGg",
                "amount": 1000,
                "currency": "INR",
                "amount_reversed": 0,
                "fees": 0,
                "tax": null,
                "notes": {
                    "branch": "Acme Corp Bangalore South",
                    "name": "Saurav Kumar"
                },
                "linked_account_notes": [
                    "branch"
                ],
                "on_hold": false,
                "on_hold_until": null,
                "settlement_status": null,
                "recipient_settlement_id": null,
                "created_at": 1654776878,
                "processed_at": null,
                "error": {
                    "code": null,
                    "description": null,
                    "reason": null,
                    "field": null,
                    "step": null,
                    "id": "trf_JfOO8M4p6tQZ6g",
                    "source": null,
                    "metadata": null
                }
            }
        ]
    }
}
```
-------------------------------------------------------------------------------------------------------

### Fetch transfer

```php
$api->transfer->fetch($transferId);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| transferId*   | string      | The id of the transfer to be fetched  |

**Response:**
```json
{
  "id": "trf_E7V62rAxJ3zYMo",
  "entity": "transfer",
  "source": "pay_E6j30Iu1R7XbIG",
  "recipient": "acc_CMaomTz4o0FOFz",
  "amount": 100,
  "currency": "INR",
  "amount_reversed": 0,
  "notes": [],
  "fees": 1,
  "tax": 0,
  "on_hold": false,
  "on_hold_until": null,
  "recipient_settlement_id": null,
  "created_at": 1579691505,
  "linked_account_notes": [],
  "processed_at": 1579691505
}
```
-------------------------------------------------------------------------------------------------------

### Fetch transfers for a settlement

```php
$api->transfer->all(array('recipient_settlement_id'=> $recipientSettlementId));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| recipientSettlementId*   | string    | The recipient settlement id obtained from the settlement.processed webhook payload.  |

**Response:**
```json
{
  "entity": "collection",
  "count": 1,
  "items": [
    {
      "id": "trf_DGSTeXzBkEVh48",
      "entity": "transfer",
      "source": "pay_DGSRhvMbOqeCe7",
      "recipient": "acc_CMaomTz4o0FOFz",
      "amount": 500,
      "currency": "INR",
      "amount_reversed": 0,
      "notes": [],
      "fees": 2,
      "tax": 0,
      "on_hold": false,
      "on_hold_until": null,
      "recipient_settlement_id": "setl_DHYJ3dRPqQkAgV",
      "created_at": 1568110256,
      "linked_account_notes": [],
      "processed_at": null
    }
  ]
}
```
-------------------------------------------------------------------------------------------------------

### Fetch settlement details

```php
$api->transfer->all(array('expand[]'=> 'recipient_settlement'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| expand*   | string    | Supported value is `recipient_settlement`  |

**Response:**
```json
{
    "entity": "collection",
    "count": 1,
    "items": [
        {
            "id": "trf_JhdmwXgQpEk38N",
            "entity": "transfer",
            "status": "processed",
            "source": "acc_HZbJUcl6DBDLIN",
            "recipient": "acc_HjVXbtpSCIxENR",
            "amount": 100,
            "currency": "INR",
            "amount_reversed": 0,
            "fees": 1,
            "tax": 0,
            "notes": [],
            "linked_account_notes": [],
            "on_hold": false,
            "on_hold_until": null,
            "settlement_status": null,
            "recipient_settlement_id": null,
            "recipient_settlement": null,
            "created_at": 1655267791,
            "processed_at": 1655267792,
            "error": {
                "code": null,
                "description": null,
                "reason": null,
                "field": null,
                "step": null,
                "id": "trf_JhdmwXgQpEk38N",
                "source": null,
                "metadata": null
            }
        }
    ]
}
```
-------------------------------------------------------------------------------------------------------

### Refund payments and reverse transfer from a linked account

```php
$api->payment->fetch($paymentId)->refund(array('amount'=> '100','reverse_all'=>'1'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |
| amount*   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |
| reverse_all   | boolean    | Reverses transfer made to a linked account. Possible values:<br> * `1` - Reverses transfer made to a linked account.<br>* `0` - Does not reverse transfer made to a linked account.|

**Response:**
```json
{
  "entity": "collection",
  "count": 1,
  "items": [
    {
      "id": "pay_JHAe1Zat55GbZB",
      "entity": "payment",
      "amount": 5000,
      "currency": "INR",
      "status": "captured",
      "order_id": "order_IluGWxBm9U8zJ8",
      "invoice_id": null,
      "international": false,
      "method": "netbanking",
      "amount_refunded": 0,
      "refund_status": null,
      "captured": true,
      "description": "Test Transaction",
      "card_id": null,
      "bank": "KKBK",
      "wallet": null,
      "vpa": null,
      "email": "gaurav.kumar@example.com",
      "contact": "+919999999999",
      "notes": {
        "address": "Razorpay Corporate Office"
      },
      "fee": 118,
      "tax": 18,
      "error_code": null,
      "error_description": null,
      "error_source": null,
      "error_step": null,
      "error_reason": null,
      "acquirer_data": {
        "bank_transaction_id": "7003347"
      },
      "created_at": 1649488316
    }
  ]
}
```
-------------------------------------------------------------------------------------------------------

### Fetch payments of a linked account

```php

$api->setHeader('X-Razorpay-Account', 'acc_IRQWUleX4BqvYn');

$api->payment->all();
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| X-Razorpay-Account   | string      | The linked account id to fetch the payments received by linked account |

**Response:**
```json
{
  "entity": "collection",
  "count": 2,
  "items": [
    {
      "id": "pay_E9uth3WhYbh9QV",
      "entity": "payment",
      "amount": 100,
      "currency": "INR",
      "status": "captured",
      "order_id": null,
      "invoice_id": null,
      "international": null,
      "method": "transfer",
      "amount_refunded": 0,
      "refund_status": null,
      "captured": true,
      "description": null,
      "card_id": null,
      "bank": null,
      "wallet": null,
      "vpa": null,
      "email": "",
      "contact": null,
      "notes": [],
      "fee": 0,
      "tax": 0,
      "error_code": null,
      "error_description": null,
      "created_at": 1580219046
    }
  ]
}
```
-------------------------------------------------------------------------------------------------------

### Reverse transfers from all linked accounts
```php
$api->transfer->fetch($transferId)->reverse(array('amount'=>'100'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| transferId*   | string      | The id of the transfer to be fetched  |
| amount   | integer      | The amount to be captured (should be equal to the authorized amount, in paise) |

**Response:**
```json
{
  "id": "rvrsl_EB0BWgGDAu7tOz",
  "entity": "reversal",
  "transfer_id": "trf_EAznuJ9cDLnF7Y",
  "amount": 100,
  "fee": 0,
  "tax": 0,
  "currency": "INR",
  "notes": [],
  "initiator_id": "CJoeHMNpi0nC7k",
  "customer_refund_id": null,
  "created_at": 1580456007
}
```
-------------------------------------------------------------------------------------------------------

### Hold settlements for transfers
```php
$api->payment->fetch($paymentId)->transfer(array('transfers' => array(array('account' => 'acc_I0QRP7PpvaHhpB','amount' => 100,'currency' => 'INR','on_hold' => true))));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |
| transfers   | array     | All parameters listed here https://razorpay.com/docs/api/route/#hold-settlements-for-transfers are supported |

**Response:**
```json
{
  "entity": "collection",
  "count": 1,
  "items": [
    {
      "id": "trf_EB1VJ4Ux4GMmxQ",
      "entity": "transfer",
      "source": "pay_EB1R2s8D4vOAKG",
      "recipient": "acc_CMaomTz4o0FOFz",
      "amount": 100,
      "currency": "INR",
      "amount_reversed": 0,
      "notes": [],
      "fees": 1,
      "tax": 0,
      "on_hold": true,
      "on_hold_until": null,
      "recipient_settlement_id": null,
      "created_at": 1580460652,
      "linked_account_notes": [],
      "processed_at": 1580460652
    }
  ]
}
```
-------------------------------------------------------------------------------------------------------

### Modify settlement hold for transfers
```php
$api->transfer->fetch($transferId)->edit(array('on_hold' => '1', 'on_hold_until' => '1679691505'));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| transferId*   | string      | The id of the transfer to be fetched  |
| on_hold*   | boolean      | Possible values is `0` or `1`  |
| on_hold_until   | integer      | Timestamp, in Unix, that indicates until when the settlement of the transfer must be put on hold |

**Response:**
```json
{
  "id": "trf_EB17rqOUbzSCEE",
  "entity": "transfer",
  "source": "pay_EAeSM2Xul8xYRo",
  "recipient": "acc_CMaomTz4o0FOFz",
  "amount": 100,
  "currency": "INR",
  "amount_reversed": 0,
  "notes": [],
  "fees": 1,
  "tax": 0,
  "on_hold": true,
  "on_hold_until": 1679691505,
  "recipient_settlement_id": null,
  "created_at": 1580459321,
  "linked_account_notes": [],
  "processed_at": 1580459321
}
```

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/route/#transfers/)**
