<?php

namespace Razorpay\Tests;

use Razorpay\Api\Api;
use Razorpay\Api\Errors\SignatureVerificationError;

class SignatureVerificationNegativeTest extends TestCase
{
    private $webhookPayload = '{"event":"payment.authorized"}';
    private $webhookSecret = 'test_webhook_secret';

    public function setUp(): void
    {
        parent::setUp();
    }

    /**
     * Test that empty signature is rejected
     */
    public function testEmptySignatureRejected()
    {
        $this->expectException(SignatureVerificationError::class);

        $this->api->utility->verifyWebhookSignature(
            $this->webhookPayload,
            '',
            $this->webhookSecret
        );
    }

    /**
     * Test that wrong length signature is rejected
     */
    public function testWrongLengthSignatureRejected()
    {
        $this->expectException(SignatureVerificationError::class);

        $this->api->utility->verifyWebhookSignature(
            $this->webhookPayload,
            'abc123',
            $this->webhookSecret
        );
    }

    /**
     * Test that non-hex signature is rejected
     */
    public function testNonHexSignatureRejected()
    {
        $this->expectException(SignatureVerificationError::class);

        $nonHexSig = str_repeat('z', 64);
        $this->api->utility->verifyWebhookSignature(
            $this->webhookPayload,
            $nonHexSig,
            $this->webhookSecret
        );
    }

    /**
     * Test that tampered valid-length hex signature is rejected
     */
    public function testTamperedValidHexSignatureRejected()
    {
        $this->expectException(SignatureVerificationError::class);

        $tamperedSig = str_repeat('a', 64);
        $this->api->utility->verifyWebhookSignature(
            $this->webhookPayload,
            $tamperedSig,
            $this->webhookSecret
        );
    }

    /**
     * Test that dynamically generated valid signature is accepted
     */
    public function testValidDynamicSignatureAccepted()
    {
        $validSig = hash_hmac('sha256', $this->webhookPayload, $this->webhookSecret);

        $this->assertNull($this->api->utility->verifyWebhookSignature(
            $this->webhookPayload,
            $validSig,
            $this->webhookSecret
        ));
    }

    /**
     * Test signature verification with special characters in payload
     */
    public function testSpecialCharsInPayload()
    {
        $specialPayload = '{"event":"payment","data":{"notes":"Test & <script>alert(1)</script>"}}';
        $validSig = hash_hmac('sha256', $specialPayload, $this->webhookSecret);

        $this->assertNull($this->api->utility->verifyWebhookSignature(
            $specialPayload,
            $validSig,
            $this->webhookSecret
        ));
    }

    /**
     * Test signature verification with unicode in payload
     */
    public function testUnicodeInPayload()
    {
        $unicodePayload = '{"event":"payment","data":{"name":"日本語テスト"}}';
        $validSig = hash_hmac('sha256', $unicodePayload, $this->webhookSecret);

        $this->assertNull($this->api->utility->verifyWebhookSignature(
            $unicodePayload,
            $validSig,
            $this->webhookSecret
        ));
    }
}
