<?php
namespace Razorpay\Tests;

use Razorpay\Api\Request;

class RefundTest extends TestCase
{
    /**
     * Specify unique payment id & refund id
     * for example plan_IEeswu4zFBRGwi & rfnd_IEjzeVghAS4vd1
     */

    private $paymentId = "pay_JsZdnTYps6TRqr";

    private $refundId = "rfnd_IEjzeVghAS4vd1";

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Fetch multiple refunds for a payment
     */
    public function testFetchMultipalRefund()
    {
        // print_r($this->paymentId);
        // exit();
        $data = $this->api->payment->fetch($this->paymentId)->fetchMultipleRefund(array("count"=>1));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }

    /**
     * Fetch a specific refund for a payment
     */
    public function testFetchRefund()
    {
        $refund = $this->api->payment->fetch($this->paymentId)->fetchMultipleRefund(array("count"=>1));
        
        $data = $this->api->payment->fetch($this->paymentId)->fetchRefund($refund['items'][0]['id']);

        $this->assertTrue(is_array($data->toArray()));
      
    }

    /**
     * Fetch all refunds
     */
    public function testFetchAllRefund()
    {
        $data = $this->api->refund->all(array("count"=>1));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }

    /**
     * Fetch particular refund
     */
    public function testParticularRefund()
    {
        $refund = $this->api->payment->fetch($this->paymentId)->fetchMultipleRefund(array("count"=>1));

        $data = $this->api->refund->fetch($refund['items'][0]['id']);

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('refund',$data->toArray()));
    }
}