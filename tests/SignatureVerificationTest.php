<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;
use Razorpay\Api\Api;
use Razorpay\Api\Utility;

class SignatureVerificationTest extends TestCase
{
    protected $api;
    private static $subscriptionId;

    public function setUp(): void
    {
        parent::setUp();
    }
    
    /**
     * Verify Payment verification
     */
    public function testPaymentVerification()
    {
        $orderId = 'order_IEIaMR65cu6nz3';
        $paymentId = 'pay_IH4NVgf4Dreq1l';
        $signature = '97f18ee6577a33ca7c37b949912de807b379afb3f39ccb571ffd76017463f8e5';

        $this->assertNull($this->api->utility->verifyPaymentSignature(array(
          'razorpay_order_id' => $orderId,
          'razorpay_payment_id' => $paymentId,
          'razorpay_signature' => $signature
        )));
    }
    
    /**
     * Verify PaymentLink verification
     */
    public function testPaymentLinkVerification()
    {
        $paymentLinkId = 'plink_IH3cNucfVEgV68';
        $paymentId = 'pay_IH3d0ara9bSsjQ';
        $paymentLinkReferenceId = 'TSsd1989';
        $paymentLinkStatus = 'paid';
        $signature = '57bab821bfe7ebcf41b32e362d16aa23d408b76c36317f960ae99a9301e4d364';

        $this->assertNull($this->api->utility->verifyPaymentSignature(array(
          'razorpay_payment_link_id' => $paymentLinkId,
          'razorpay_payment_link_reference_id' => $paymentLinkReferenceId,
          'razorpay_payment_link_status' => $paymentLinkStatus,
          'razorpay_payment_id' => $paymentId,
          'razorpay_signature' => $signature
        )));
    }

    /**
     * Verify Subscription verification
     */
    public function testSubscriptionVerification()
    {
        $subscriptionId = 'sub_ID6MOhgkcoHj9I';
        $paymentId = 'pay_IDZNwZZFtnjyym';
        $signature = 'cbbaabf163d61fc9346b794b5f906bc2f6b0d944be71bc0e6b5c35fa21eade44';

        $this->assertNull($this->api->utility->verifyPaymentSignature(array(
          'razorpay_subscription_id' => $subscriptionId,
          'razorpay_payment_id' => $paymentId,
          'razorpay_signature' => $signature
        )));
    }
    
    /**
     * Test verification with OAuth token authentication
     */
    public function testOAuthTokenVerification()
    {
        $orderId = 'order_123456789';
        $paymentId = 'pay_123456789';
        $secret = 'test_secret_key';
        
        // The payload that would be used for signature verification
        $payload = $orderId . '|' . $paymentId;
        
        // Generate a valid signature using the test secret
        $expectedSignature = hash_hmac('sha256', $payload, $secret);
        
        // Create a new API instance with OAuth token
        $apiWithOAuth = new Api(null, null, 'test_oauth_token');
        
        // This should work now with the secret passed in attributes
        $this->assertNull($apiWithOAuth->utility->verifyPaymentSignature([
            'razorpay_order_id' => $orderId,
            'razorpay_payment_id' => $paymentId,
            'razorpay_signature' => $expectedSignature,
            'secret' => $secret
        ]));
    }
    
    /**
     * Test webhook verification with OAuth token authentication
     */
    public function testOAuthTokenWebhookVerification()
    {
        $payload = '{"payment_id":"pay_123456789","order_id":"order_123456789"}';
        $secret = 'webhook_secret_key';
        
        // Generate a valid signature using the test secret
        $expectedSignature = hash_hmac('sha256', $payload, $secret);
        
        // Create a new API instance with OAuth token
        $apiWithOAuth = new Api(null, null, 'test_oauth_token');
        
        // Verify webhook signature with explicit secret
        $this->assertNull($apiWithOAuth->utility->verifyWebhookSignature($payload, $expectedSignature, $secret));
    }
}