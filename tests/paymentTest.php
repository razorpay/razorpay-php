<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class paymentTest extends TestCase
{
    private static $orderId;

    private static $paymentId;

    public function setUp()
    {
        parent::setUp();
    }    

    /**
     * Fetch all payment
     */
    public function testfetchAll()
    {
        $data = $this->api->payment->all();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }
    
    /**
     * Fetch a payment
     */
    public function testfetchPayment()
    {
        $payment = $this->api->payment->all();
        
        if($payment['count'] !== 0){
             
            $data = $this->api->payment->fetch($payment['items'][0]['id']);
            
            self::$orderId = 'order_IEcrUMyevZFuCS';

            self::$paymentId = 'pay_IEczPDny6uzSnx';

            $this->assertTrue(is_array($data->toArray()));

            $this->assertTrue(in_array('payment',$data->toArray()));
        }
    } 
    
    /**
     * Fetch a payment
     */
    public function testfetchOrderPayment()
    {
        $data = $this->api->order->fetch(self::$orderId)->payments();

        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(is_array($data['items']));
    }

    /**
     * Update a payment
     */
    public function testUpdatePayment()
    {
        $data = $this->api->payment->fetch(self::$paymentId)->edit(array('notes'=> array('key_1'=> 'value1','key_2'=> 'value2')));

        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(in_array('payment',$data->toArray()));
    }

    /**
     * Update a payment
     */
    public function testFetchCard()
    {
        $data = $this->api->payment->all(array('expand[]'=>'card'));

        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(is_array($data['items']));
    }

    /**
     * Update a payment
     */
    public function testFetchEmi()
    {
        $data = $this->api->payment->all(array('expand[]'=>'emi'));

        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(is_array($data['items']));
    }

    /**
     * Fetch card details with paymentId
     */
    public function testFetchCardWithPaymentId()
    {
        $data = $this->api->payment->fetch(self::$paymentId)->fetchCardDetails();
        
        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(in_array('card',$data->toArray())); 
    }

    /**
     * Fetch Payment Downtime Details
     */
    public function testfetchPaymentDowntime()
    {
        $data = $this->api->payment->fetchPaymentDowntime();

        $this->assertTrue(is_array($data->toArray()));
       
        $this->assertTrue(in_array('count',$data->toArray())); 
    }

    /**
     * Fetch Payment Downtime Details
     */
    public function testfetchPaymentDowntimeById()
    {
        $downtime = $this->api->payment->fetchPaymentDowntime();
 
        $data = $this->api->payment->fetchPaymentDowntimeById($downtime['items'][0]['id']);

        $this->assertTrue(is_array($data->toArray()));
        
    }

}
