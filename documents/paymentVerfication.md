## payment verification

### Verify payment verification

```php
$api->utility->verifyPaymentSignature(array('razorpay_order_id' => $razorpayOrderId, 'razorpay_payment_id' => $razorpayPaymentId, 'razorpay_signature' => $razorpaySignature));
```

**Parameters:**


| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| orderId*  | string | The id of the order to be fetched  |
| paymentId*    | string | The id of the payment to be fetched |
| signature* | string   | Signature returned by the Checkout. This is used to verify the payment. |

-------------------------------------------------------------------------------------------------------
### Verify subscription verification

```php
$api->utility->verifyPaymentSignature(array('razorpay_subscription_id' => $razorpaySubscriptionId, 'razorpay_payment_id' => $razorpayPaymentId, 'razorpay_signature' => $razorpaySignature));
```

**Parameters:**


| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| subscriptionId*  | string | The id of the subscription to be fetched  |
| paymentId*    | string | The id of the payment to be fetched |
| signature* | string   | Signature returned by the Checkout. This is used to verify the payment. |

-------------------------------------------------------------------------------------------------------
### Verify paymentlink verification

```php
$api->utility->verifyPaymentSignature(array('razorpay_payment_link_id' => $razorpayPaymentlinkId, 'razorpay_payment_id' => $razorpayPaymentId, 'razorpay_payment_link_reference_id' => $razorpayPaymentLinkReferenceId, 'razorpay_payment_link_status' => $razorpayPaymentLinkStatus, 'razorpay_signature' => $razorpayPaymentLinkSignature));
```

**Parameters:**


| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| razorpayPaymentlinkId*  | string | The id of the paymentlink to be fetched  |
| razorpayPaymentId*  | string | The id of the payment to be fetched  |
| razorpayPaymentLinkReferenceId*  | string |  A reference number tagged to a Payment Link |
| razorpayPaymentLinkStatus*  | string | Current status of the link  |
| razorpayPaymentLinkSignature*    | string | Signature returned by the Checkout. This is used to verify the payment. |

-------------------------------------------------------------------------------------------------------
### Verify webhook verification

```php
webhookbody := ``;

    $webhook_body = '{"entity":"event","account_id":"acc_HVFD0PFnHPAzKj","event":"payment.authorized","contains":["payment"],"payload":{"payment":{"entity":{"id":"pay_JUEM4c0pSLpFEW","entity":"payment","amount":12300,"currency":"INR","status":"authorized","order_id":"order_JUELuT6cFaHkvd","invoice_id":null,"international":false,"method":"netbanking","amount_refunded":0,"refund_status":null,"captured":false,"description":"#JUELZ1z1EC0pwi","card_id":null,"bank":"SBIN","wallet":null,"vpa":null,"email":"gaurav.kumar@example.com","contact":"+919999999999","notes":[],"fee":null,"tax":null,"error_code":null,"error_description":null,"error_source":null,"error_step":null,"error_reason":null,"acquirer_data":{"bank_transaction_id":"6416615"},"created_at":1652339804}}},"created_at":1652339806}';

    $signature = "56df260ab4647b07b729b0b48d2a95b71de42f109884949e5ec387a2bb8b6919";
    $webhook_secret = "123456";
	$api->utility->verifyWebhookSignature($webhook_body, $signature, $webhook_secret);
```

**Parameters:**


| Name  | Type      | Description                                      |
|-------|-----------|--------------------------------------------------|
| webhook_body*  | string | raw webhook request body  |
| signature*  | string | The hash signature is calculated using HMAC with SHA256 algorithm; with your webhook secret set as the key and the webhook request body as the message.  |
| webhook_secret* | string   | your webhook secret |


**PN: * indicates mandatory fields**
<br>
<br>
