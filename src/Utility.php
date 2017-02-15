<?php

namespace Razorpay\Api;

class Utility
{
    const SHA256 = 'sha256';

    public function verifyPaymentSignature($attributes)
    {
        $exceptedSignature = $attributes['razorpay_signature'];
        $orderId = $attributes['razorpay_order_id'];
        $paymentId = $attributes['razorpay_payment_id'];

        $payload = $orderId . '|' . $paymentId;

        return self::validateSignature($payload, $exceptedSignature);
    }

    public function verifyWebhookSignature($payload, $exceptedSignature)
    {
        return self::verifySignature($payload, $exceptedSignature);
    }

    public function verifySignature($payload, $exceptedSignature)
    {
        $actualSignature = hash_hmac(self::SHA256, $payload, Api::getSecret());

        if (function_exists('hash_equals'))
        {
            if (hash_equals($actualSignature, $exceptedSignature) === true)
            {
                return true;
            }
        }
        else if ($this->hash_equals($actualSignature, $exceptedSignature) === true)
        {
            return true;
        }

        throw new Errors\BadRequestError(
            'Invalid signature');
    }

    private function hash_equals($actualSignature, $exceptedSignature)
    {
        if (strlen($exceptedSignature) === strlen($actualSignature))
        {
            $res = $exceptedSignature ^ $actualSignature;
            $return = 0;

            for ($i = strlen($res) - 1; $i >= 0; $i--)
            {
                $return |= ord($res[$i]);
            }

            return ($return === 0);
        }

        return false;
    }
}