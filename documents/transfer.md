## Transfers

### Create transfers from payment

```php
$api->payment->fetch($paymentId)->transfer(array('transfers' => array(array('account' => 'acc_I0QRP7PpvaHhpB','amount' => 100,'currency' => 'INR','notes' =>  array ('name' => 'Gaurav Kumar','roll_no' => 'IEC2011025',),'linked_account_notes' => array ('roll_no'),'on_hold' => true,'on_hold_until' => 1671222870))));
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| paymentId*   | string      | The id of the payment to be fetched  |
| transfers   | array     | All parameters listed [here](https://razorpay.com/docs/api/payments/route/#fetch-transfers-for-a-payment) are supported ||

**Response:**
```json
{
   "entity":"collection",
   "count":2,
   "items":[
      {
         "id":"trf_ECB6hP5cyN30pU",
         "entity":"transfer",
         "transfer_status":"failed",
         "settlement_status":null,
         "source":"pay_EB1R2s8D4vOAKG",
         "recipient":"acc_CNo3jSI8OkFJJJ",
         "amount":100,
         "currency":"INR",
         "amount_reversed":0,
         "notes":{
            "name":"Saurav Kumar",
            "roll_no":"IEC2011026"
         },
         "error":{
            "code":"BAD_REQUEST_TRANSFER_INSUFFICIENT_BALANCE",
            "description":"Transfer failed due to insufficient balance",
            "field":null,
            "source":"transfer",
            "step":"balance_check",
            "reason":"insufficient_balance"
         },
         "fees":1,
         "tax":0,
         "on_hold":false,
         "on_hold_until":null,
         "recipient_settlement_id":null,
         "created_at":1580712811,
         "linked_account_notes":[
            "roll_no"
         ],
         "processed_at":1580712811
      },
      {
         "id":"trf_ECB6hP5cyN30pU",
         "entity":"transfer",
         "transfer_status":"failed",
         "settlement_status":null,
         "source":"pay_EB1R2s8D4vOAKG",
         "recipient":"acc_CNo3jSI8OkFJJJ",
         "amount":100,
         "currency":"INR",
         "amount_reversed":0,
         "notes":{
            "name":"Saurav Kumar",
            "roll_no":"IEC2011026"
         },
         "error":{
            "code":"BAD_REQUEST_PAYMENT_FEES_GREATER_THAN_AMOUNT",
            "description":"Transfer amount was greater than amount available for transfer",
            "field":null,
            "source":"transfer",
            "step":"amount_validation",
            "reason":"transfer_amount_higher_than_balance"
         },
         "fees":1,
         "tax":0,
         "on_hold":false,
         "on_hold_until":null,
         "recipient_settlement_id":null,
         "created_at":1580712811,
         "linked_account_notes":[
            "roll_no"
         ],
         "processed_at":1580712811
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
| transfers   | array     | All parameters listed [here](https://razorpay.com/docs/api/payments/route/#create-transfers-from-orders) are supported |

**Response:**
```json
{
  "id": "order_JJCYnu3hipocHz",
  "entity": "order",
  "amount": 2000,
  "amount_paid": 0,
  "amount_due": 2000,
  "currency": "INR",
  "receipt": null,
  "offer_id": null,
  "offers": {
    "entity": "collection",
    "count": 0,
    "items": []
  },
  "status": "created",
  "attempts": 0,
  "notes": [],
  "created_at": 1649931742,
  "transfers": [
    {
      "id": "trf_JJCYnw77tqUT9r",
      "entity": "transfer",
      "status": "created",
      "source": "order_JJCYnu3hipocHz",
      "recipient": "acc_IRQWUleX4BqvYn",
      "amount": 1000,
      "currency": "INR",
      "amount_reversed": 0,
      "notes": {
        "branch": "Acme Corp Bangalore North",
        "name": "Gaurav Kumar"
      },
      "linked_account_notes": [
        "branch"
      ],
      "on_hold": true,
      "on_hold_until": 1671222870,
      "recipient_settlement_id": null,
      "created_at": 1649931742,
      "processed_at": null,
      "error": {
        "code": null,
        "description": null,
        "reason": null,
        "field": null,
        "step": null,
        "id": "trf_JJCYnw77tqUT9r",
        "source": null,
        "metadata": null
      }
    },
    {
      "id": "trf_JJCYnxe5GV19Kk",
      "entity": "transfer",
      "status": "created",
      "source": "order_JJCYnu3hipocHz",
      "recipient": "acc_IROu8Nod6PXPtZ",
      "amount": 1000,
      "currency": "INR",
      "amount_reversed": 0,
      "notes": {
        "branch": "Acme Corp Bangalore South",
        "name": "Saurav Kumar"
      },
      "linked_account_notes": [
        "branch"
      ],
      "on_hold": false,
      "on_hold_until": null,
      "recipient_settlement_id": null,
      "created_at": 1649931742,
      "processed_at": null,
      "error": {
        "code": null,
        "description": null,
        "reason": null,
        "field": null,
        "step": null,
        "id": "trf_JJCYnxe5GV19Kk",
        "source": null,
        "metadata": null
      }
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
   "id":"trf_E9utgtfGTcpcmm",
   "entity":"transfer",
   "transfer_status":"pending",
   "settlement_status":null,
   "source":"acc_CJoeHMNpi0nC7k",
   "recipient":"acc_CPRsN1LkFccllA",
   "amount":100,
   "currency":"INR",
   "amount_reversed":0,
   "notes":[
      
   ],
   "fees":1,
   "tax":0,
   "on_hold":false,
   "on_hold_until":null,
   "recipient_settlement_id":null,
   "created_at":1580219046,
   "linked_account_notes":[
      
   ],
   "processed_at":null,
   "error":{
      "code":null,
      "description":null,
      "field":null,
      "source":null,
      "step":null,
      "reason":null
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
  "count": 2,
  "items": [
    {
      "id": "trf_JJD535tJtk6Yy0",
      "entity": "transfer",
      "status": "processed",
      "source": "pay_JGmCgTEa9OTQcX",
      "recipient": "acc_IROu8Nod6PXPtZ",
      "amount": 100,
      "currency": "INR",
      "amount_reversed": 0,
      "fees": 1,
      "tax": 0,
      "notes": {
        "name": "Gaurav Kumar",
        "roll_no": "IEC2011025"
      },
      "linked_account_notes": [
        "roll_no"
      ],
      "on_hold": true,
      "on_hold_until": 1671222870,
      "settlement_status": "on_hold",
      "recipient_settlement_id": null,
      "created_at": 1649933574,
      "processed_at": 1649933579,
      "error": {
        "code": null,
        "description": null,
        "reason": null,
        "field": null,
        "step": null,
        "id": "trf_JJD535tJtk6Yy0",
        "source": null,
        "metadata": null
      }
    },
    {
      "id": "trf_JJD536GI6wuz3m",
      "entity": "transfer",
      "status": "processed",
      "source": "pay_JGmCgTEa9OTQcX",
      "recipient": "acc_IRQWUleX4BqvYn",
      "amount": 300,
      "currency": "INR",
      "amount_reversed": 0,
      "fees": 1,
      "tax": 0,
      "notes": {
        "name": "Saurav Kumar",
        "roll_no": "IEC2011026"
      },
      "linked_account_notes": [
        "roll_no"
      ],
      "on_hold": false,
      "on_hold_until": null,
      "settlement_status": "pending",
      "recipient_settlement_id": null,
      "created_at": 1649933574,
      "processed_at": 1649933579,
      "error": {
        "code": null,
        "description": null,
        "reason": null,
        "field": null,
        "step": null,
        "id": "trf_JJD536GI6wuz3m",
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
$param = array('expand[]'=>'transfers');

$api->order->fetch($orderId)->transfers($param);
```

**Parameters:**

| Name          | Type        | Description                                 |
|---------------|-------------|---------------------------------------------|
| orderId*   | string      | The id of the order to be fetched  |
| expand[]*   | string    | Supported value is `transfer`  |

**Response:**
```json
{
  "id": "order_JJCYnu3hipocHz",
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
  "created_at": 1649931742,
  "transfers": {
    "entity": "collection",
    "count": 2,
    "items": [
      {
        "id": "trf_JJCYnw77tqUT9r",
        "entity": "transfer",
        "status": "created",
        "source": "order_JJCYnu3hipocHz",
        "recipient": "acc_IRQWUleX4BqvYn",
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
        "created_at": 1649931742,
        "processed_at": null,
        "error": {
          "code": null,
          "description": null,
          "reason": null,
          "field": null,
          "step": null,
          "id": "trf_JJCYnw77tqUT9r",
          "source": null,
          "metadata": null
        }
      },
      {
        "id": "trf_JJCYnxe5GV19Kk",
        "entity": "transfer",
        "status": "created",
        "source": "order_JJCYnu3hipocHz",
        "recipient": "acc_IROu8Nod6PXPtZ",
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
        "created_at": 1649931742,
        "processed_at": null,
        "error": {
          "code": null,
          "description": null,
          "reason": null,
          "field": null,
          "step": null,
          "id": "trf_JJCYnxe5GV19Kk",
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
  "id": "trf_JJD536GI6wuz3m",
  "entity": "transfer",
  "status": "processed",
  "source": "pay_JGmCgTEa9OTQcX",
  "recipient": "acc_IRQWUleX4BqvYn",
  "amount": 300,
  "currency": "INR",
  "amount_reversed": 0,
  "fees": 1,
  "tax": 0,
  "notes": {
    "name": "Saurav Kumar",
    "roll_no": "IEC2011026"
  },
  "linked_account_notes": [
    "roll_no"
  ],
  "on_hold": false,
  "on_hold_until": null,
  "settlement_status": "pending",
  "recipient_settlement_id": null,
  "created_at": 1649933574,
  "processed_at": 1649933579,
  "error": {
    "code": null,
    "description": null,
    "reason": null,
    "field": null,
    "step": null,
    "id": "trf_JJD536GI6wuz3m",
    "source": null,
    "metadata": null
  }
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
      "id": "trf_HWjmkReRGPhguR",
      "entity": "transfer",
      "status": "processed",
      "source": "pay_HWjY9DZSMsbm5E",
      "recipient": "acc_HWjl1kqobJzf4i",
      "amount": 1000,
      "currency": "INR",
      "amount_reversed": 0,
      "fees": 3,
      "tax": 0,
      "notes": [],
      "linked_account_notes": [],
      "on_hold": false,
      "on_hold_until": null,
      "settlement_status": "settled",
      "recipient_settlement_id": "setl_HYIIk3H0J4PYdX",
      "created_at": 1625812996,
      "processed_at": 1625812996,
      "error": {
        "code": null,
        "description": null,
        "reason": null,
        "field": null,
        "step": null,
        "id": "trf_HWjmkReRGPhguR",
        "source": null,
        "metadata": null
      }
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
  "count": 2,
  "items": [
    {
      "id": "trf_JCu3ZstilY6Whi",
      "entity": "transfer",
      "status": "failed",
      "source": "pay_HWjY9DZSMsbm5E",
      "recipient": "acc_CNo3jSI8OkFJJJ",
      "amount": 100,
      "currency": "INR",
      "amount_reversed": 0,
      "fees": 0,
      "tax": null,
      "notes": {
        "name": "Saurav Kumar",
        "roll_no": "IEC2011026"
      },
      "linked_account_notes": [
        "roll_no"
      ],
      "on_hold": false,
      "on_hold_until": null,
      "settlement_status": null,
      "recipient_settlement_id": null,
      "recipient_settlement": null,
      "created_at": 1648556539,
      "processed_at": 1648556543,
      "error": {
        "code": "BAD_REQUEST_TRANSFER_INSUFFICIENT_BALANCE",
        "description": "Account does not have sufficient balance to carry out transfer operation",
        "reason": "insufficient_account_balance",
        "field": "amount",
        "step": "transfer_processing",
        "id": "trf_JCu3ZstilY6Whi",
        "source": null,
        "metadata": null
      }
    },
    {
      "id": "trf_JCu3ZsTVSuy7oN",
      "entity": "transfer",
      "status": "failed",
      "source": "pay_HWjY9DZSMsbm5E",
      "recipient": "acc_CPRsN1LkFccllA",
      "amount": 100,
      "currency": "INR",
      "amount_reversed": 0,
      "fees": 0,
      "tax": null,
      "notes": {
        "name": "Gaurav Kumar",
        "roll_no": "IEC2011025"
      },
      "linked_account_notes": [
        "roll_no"
      ],
      "on_hold": true,
      "on_hold_until": 1671222870,
      "settlement_status": null,
      "recipient_settlement_id": null,
      "recipient_settlement": null,
      "created_at": 1648556539,
      "processed_at": 1648556543,
      "error": {
        "code": "BAD_REQUEST_TRANSFER_INSUFFICIENT_BALANCE",
        "description": "Account does not have sufficient balance to carry out transfer operation",
        "reason": "insufficient_account_balance",
        "field": "amount",
        "step": "transfer_processing",
        "id": "trf_JCu3ZsTVSuy7oN",
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
  "id": "rfnd_JJFNlNXPHY640A",
  "entity": "refund",
  "amount": 100,
  "currency": "INR",
  "payment_id": "pay_JJCqynf4fQS0N1",
  "notes": [],
  "receipt": null,
  "acquirer_data": {
    "arn": null
  },
  "created_at": 1649941680,
  "batch_id": null,
  "status": "processed",
  "speed_processed": "normal",
  "speed_requested": "normal"
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
      "id": "pay_JJCqynf4fQS0N1",
      "entity": "payment",
      "amount": 10000,
      "currency": "INR",
      "status": "captured",
      "order_id": "order_JJCqnZG8f3754z",
      "invoice_id": null,
      "international": false,
      "method": "netbanking",
      "amount_refunded": 0,
      "refund_status": null,
      "captured": true,
      "description": "#JJCqaOhFihfkVE",
      "card_id": null,
      "bank": "YESB",
      "wallet": null,
      "vpa": null,
      "email": "john.example@example.com",
      "contact": "+919820958250",
      "notes": [],
      "fee": 236,
      "tax": 36,
      "error_code": null,
      "error_description": null,
      "error_source": null,
      "error_step": null,
      "error_reason": null,
      "acquirer_data": {
        "bank_transaction_id": "2118867"
      },
      "created_at": 1649932775
    },
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
      "id": "trf_JJFXnxnvFUhQAy",
      "entity": "transfer",
      "status": "pending",
      "source": "pay_IRPVLKW4sQ5BMX",
      "recipient": "acc_IRQWUleX4BqvYn",
      "amount": 100,
      "currency": "INR",
      "amount_reversed": 0,
      "notes": [],
      "linked_account_notes": [],
      "on_hold": true,
      "on_hold_until": null,
      "recipient_settlement_id": null,
      "created_at": 1649942250,
      "processed_at": null,
      "error": {
        "code": null,
        "description": null,
        "reason": null,
        "field": null,
        "step": null,
        "id": "trf_JJFXnxnvFUhQAy",
        "source": null,
        "metadata": null
      }
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
  "id": "trf_JJD536GI6wuz3m",
  "entity": "transfer",
  "status": "processed",
  "source": "pay_JGmCgTEa9OTQcX",
  "recipient": "acc_IRQWUleX4BqvYn",
  "amount": 300,
  "currency": "INR",
  "amount_reversed": 0,
  "fees": 1,
  "tax": 0,
  "notes": {
    "name": "Saurav Kumar",
    "roll_no": "IEC2011026"
  },
  "linked_account_notes": [
    "roll_no"
  ],
  "on_hold": true,
  "on_hold_until": 1649971331,
  "settlement_status": "on_hold",
  "recipient_settlement_id": null,
  "created_at": 1649933574,
  "processed_at": 1649933579,
  "error": {
    "code": null,
    "description": null,
    "reason": null,
    "field": null,
    "step": null,
    "id": "trf_JJD536GI6wuz3m",
    "source": null,
    "metadata": null
  }
}
```

-------------------------------------------------------------------------------------------------------

**PN: * indicates mandatory fields**
<br>
<br>
**For reference click [here](https://razorpay.com/docs/api/route/#transfers/)**
