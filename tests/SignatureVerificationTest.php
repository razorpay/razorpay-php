<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;
use Razorpay\Api\Api;

class SignatureVerificationTest extends TestCase
{
    private static $subscriptionId;

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Verify Payment verification
     */
    // public function testPaymentVerification()
    // {
    //     $this->api = new Api( "test_key", "123456");

    //     $orderId = 'order_IEIaMR65cu6nz3';
    //     $paymentId = 'pay_IH4NVgf4Dreq1l';
    //     $signature = '26ef68cd4f38e48828411aaaeaaaca2aa250ee494cccac31b2aedf24c3573414';

    //     $this->assertTrue(true,$this->api->utility->verifyPaymentSignature(array(
    //       'razorpay_order_id' => $orderId,
    //       'razorpay_payment_id' => $paymentId,
    //       'razorpay_signature' => $signature
    //     )));
    // }
    
    /**
     * Verify PaymentLink verification
     */
    public function testPaymentLinkVerification()
    {
        $this->api = new Api( "test_key", "123456");

        $paymentLinkId = 'plink_IH3cNucfVEgV68';
        $paymentId = 'pay_IH3d0ara9bSsjQ';
        $paymentLinkReferenceId = 'TSsd1989';
        $paymentLinkStatus = 'paid';
        $signature = '059383f7d94721d22cd2be6d4c690cb1b3536d0704694fd015131dff22d64738';

        $this->assertTrue(true,$this->api->utility->verifyPaymentSignature(array(
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
        $this->api = new Api( "test_key", "123456");

        $subscriptionId = 'sub_ID6MOhgkcoHj9I';
        $paymentId = 'pay_IDZNwZZFtnjyym';
        $signature = '1c8a276e8d45894343f4e76d08502a933aceea478a7879473a79f3dfc0393659';

        $this->assertTrue(true,$this->api->utility->verifyPaymentSignature(array(
          'razorpay_subscription_id' => $subscriptionId,
          'razorpay_payment_id' => $paymentId,
          'razorpay_signature' => $signature
        )));
    }
}