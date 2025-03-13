<?php

namespace Razorpay\Api;

class Utility
{
    const SHA256 = 'sha256';

    public function verifyPaymentSignature($attributes)
    {
        $actualSignature = $attributes['razorpay_signature'];

        $paymentId = $attributes['razorpay_payment_id'];

        if (isset($attributes['razorpay_order_id']) === true)
        {
            $orderId = $attributes['razorpay_order_id'];

            $payload = $orderId . '|' . $paymentId;
        }
        else if (isset($attributes['razorpay_subscription_id']) === true)
        {
            $subscriptionId = $attributes['razorpay_subscription_id'];

            $payload = $paymentId . '|' . $subscriptionId;
        }
        else if (isset($attributes['razorpay_payment_link_id']) === true)
        {
            $paymentLinkId     = $attributes['razorpay_payment_link_id'];

            $paymentLinkRefId  = $attributes['razorpay_payment_link_reference_id'];

            $paymentLinkStatus = $attributes['razorpay_payment_link_status'];

            $payload = $paymentLinkId . '|'. $paymentLinkRefId . '|' . $paymentLinkStatus . '|' . $paymentId;
        }
        else
        {
            throw new Errors\SignatureVerificationError(
                'Either razorpay_order_id or razorpay_subscription_id or razorpay_payment_link_id must be present.');
        }

        $secret = Api::getSecret();

        self::verifySignature($payload, $actualSignature, $secret);
    }

    public function verifyWebhookSignature($payload, $actualSignature, $secret)
    {
        self::verifySignature($payload, $actualSignature, $secret);
    }

    public function verifySignature($payload, $actualSignature, $secret)
    {
        $expectedSignature = hash_hmac(self::SHA256, $payload, $secret);

        // Use lang's built-in hash_equals if exists to mitigate timing attacks
        if (function_exists('hash_equals'))
        {
            $verified = hash_equals($expectedSignature, $actualSignature);
        }
        else
        {
            $verified = $this->hashEquals($expectedSignature, $actualSignature);
        }

        if ($verified === false)
        {
            throw new Errors\SignatureVerificationError(
                'Invalid signature passed');
        }
    }

    public function generateOnboardingSignature($data, $secret){
        $jsonStr = json_encode($data);
        return $this->encrypt($jsonStr, $secret);
    }
    
    private function encrypt($dataToEncrypt, $secret) {
        try {
            // Use the first 16 bytes of the secret as the key
            $key = substr($secret, 0, 16);
    
            // Use the first 12 bytes of the key as IV
            $iv = substr($key, 0, 12);
    
            // Encrypt the data using AES-128-GCM
            $cipher = 'aes-128-gcm';
            $tag = ''; // Authentication tag will be filled after encryption
            $encryptedData = openssl_encrypt($dataToEncrypt, $cipher, $key, OPENSSL_RAW_DATA, $iv, $tag, '', 16);
    
            if ($encryptedData === false) {
                throw new Exception('Encryption failed');
            }
    
            // Concatenate encrypted data with the authentication tag
            $finalData = $encryptedData . $tag;
    
            // Convert to hex string
            return bin2hex($finalData);
        } catch (Exception $e) {
            throw new Exception('Encryption failed: ' . $e->getMessage());
        }
    }

    private function hashEquals($expectedSignature, $actualSignature)
    {
        if (strlen($expectedSignature) === strlen($actualSignature))
        {
            $res = $expectedSignature ^ $actualSignature;
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
