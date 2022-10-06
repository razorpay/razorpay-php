<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class AddonTest extends TestCase
{
    /**
     * Specify unique addon id & plan id 
     * for example ao_IEf05Yeu52LlKL & plan_IEeswu4zFBRGwi
     */
    
    private $addonId = "ao_IEf05Yeu52LlKL";

    private $planId = "plan_IEeswu4zFBRGwi";

    private $paymentId = "pay_JsZdnTYps6TRqr";

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Create an Add-on
     */
    public function testCreateAddon()
    {
        $subscription = $this->api->subscription->create(array('plan_id' => $this->planId, 'customer_notify' => 1,'quantity'=>1, 'total_count' => 6, 'addons' => array(array('item' => array('name' => 'Delivery charges', 'amount' => 3000, 'currency' => 'INR'))),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
        
        $data =  $this->api->subscription->fetch($subscription->id)->createAddon(array('item' => array('name' => 'Extra Chair', 'amount' => 3000, 'currency' => 'INR'), 'quantity' => 1));

        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(is_object($data['item']));
    }

    /**
     * Create an instant refund
     */
    public function testCreateRefund()
    {
        $data = $this->api->payment->fetch($this->paymentId)->refund(array("amount"=> "100", "speed"=>"optimum", "receipt"=>"Receipt No. ".time()));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('refund',$data->toArray()));
    }

    /**
    * Refund payments and reverse transfer from a linked account
    */
    public function testRefundPayment()
    {
        $data = $this->api->payment->fetch("pay_Jsxnbh4vr6TLsA")->refund(array('amount'=> '100'));
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('refund',$data->toArray()));
    }

        /**
     * Update the refund
     */
    public function UpdateRefund()
    {
        $attributes = json_encode(array('notes'=> array('notes_key_1'=>'Beam me up Scotty.', 'notes_key_2'=>'Engage')));

        Request::addHeader('Content-Type', 'application/json');
        
        $refund = $this->api->payment->fetch($this->paymentId)->fetchMultipleRefund(array("count"=>1));

        $data = $this->api->refund->fetch($refund['items'][0]['id'])->edit($attributes);
         
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('refund',$data->toArray()));
    }
    
    /**
     * Fetch Subscription Link by ID
     */
    public function testFetchSubscriptionLink()
    {
        $data = $this->api->addon->fetch($this->addonId);
        
        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue($data['entity']=='addon');
    }
    
    /**
     * Fetch all addons
     */
    public function testFetchAllAddon()
    {
        $data = $this->api->addon->fetchAll();
        
        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(is_array($data['items']));
    }

}