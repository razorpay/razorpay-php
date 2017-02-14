<?php

namespace Razorpay\Api;

class Utility
{
    const HASH_ALGO = 'sha256';

    public function validatePaymentSignature($attributes, $exceptedSignature)
    {
        ksort($attributes);

        unset($attributes['razorpay_signature']);

        $payload = implode('|', $attributes);

        return self::validateSignature($payload, $exceptedSignature);
    }

    public function validateWebhookSignature($payload, $exceptedSignature)
    {
        return self::validateSignature($payload, $exceptedSignature);
    }

    public function validateSignature($payload, $exceptedSignature)
    {
        $actualSignature = hmac_hash(self::HASH_ALGO, $payload, Api::getSecret());

        if (function_exists('hash_equals'))
        {
            if (hash_equals($actualSignature, $exceptedSignature) === true)
            {
                return true;
            }
        }
        else if ($actualSignature === $exceptedSignature)
        {
            return true;
        }

        throw new Errors\BadRequestError(
            'Invalid signature');
    }
}