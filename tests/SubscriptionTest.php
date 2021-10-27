<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class SubscriptionTest extends TestCase
{
    private static $subscriptionId;

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Create a Subscription Link
     */
    public function testcreate()
    {
        $plan = $this->api->plan->create(array('period' => 'weekly', 'interval' => 1, 'item' => array('name' => 'Test Weekly 1 plan', 'description' => 'Description for the weekly 1 plan', 'amount' => 600, 'currency' => 'INR'),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));  

        $data = $this->api->subscription->create(array('plan_id' => $plan->id, 'customer_notify' => 1,'quantity'=>1, 'total_count' => 6, 'addons' => array(array('item' => array('name' => 'Delivery charges', 'amount' => 3000, 'currency' => 'INR'))),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
        
        self::$subscriptionId = 'sub_IEKtBfPIqTHLWd';

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('id',$data->toArray()));
    }
    
    /**
     * Fetch Subscription Link by ID
     */
    public function testFetchId()
    {
        $data = $this->api->subscription->fetch(self::$subscriptionId);
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('plan_id',$data->toArray()));
    }

    /**
     * Pause a Subscription
     */
    public function testPause()
    {

      $data = $this->api->subscription->fetch(self::$subscriptionId)->pause(['pause_at'=>'now']);

      $this->assertTrue(is_array($data->toArray()));

      $this->assertTrue(in_array('id',$data->toArray()));

      $this->assertTrue($data['status'] == 'paused');

    }  
    
    /**
     * Resume a Subscription
     */
    public function testResume()
    {
      $data = $this->api->subscription->fetch(self::$subscriptionId)->resume(['resume_at'=>'now']);

      $this->assertTrue(is_array($data->toArray()));

      $this->assertTrue(in_array('id',$data->toArray()));

      $this->assertTrue($data['status'] == 'active');
    } 
    
    /**
     * Update a Subscription
     */
    public function testupdate()
    {
        $data = $this->api->subscription->fetch(self::$subscriptionId)->update(array('schedule_change_at'=>'cycle_end','quantity'=>2));
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('customer_id',$data->toArray()));
    }

    /**
     * Fetch Details of a Pending Update
     */
    public function testpendingUpdate()
    {
      $data = $this->api->subscription->fetch(self::$subscriptionId)->pendingUpdate();

      $this->assertTrue(is_array($data->toArray()));

      $this->assertTrue(in_array('id',$data->toArray()));
    }

    /**
     * Cancel an Update
     */
    public function testCancelUpdate()
    {
      $data = $this->api->subscription->fetch(self::$subscriptionId)->cancelScheduledChanges();

      $this->assertTrue(is_array($data->toArray()));

      $this->assertTrue(in_array('id',$data->toArray()));
    }  

    /**
     * Fetch All Invoices for a Subscription
     */
    public function testSubscriptionInvoices()
    {
      $data = $this->api->invoice->all(['subscription_id'=>self::$subscriptionId]);

      $this->assertTrue(is_array($data->toArray()));

      $this->assertTrue(is_array($data['items']));
    } 

    /**
     * Fetch all Add-ons
     */
    public function testFetchAddons()
    {
      $data =  $this->api->addon->fetchAll();

      $this->assertTrue(is_array($data->toArray()));

      $this->assertTrue(is_array($data['items']));
    }
    
    /**
     * Fetch all subscriptions
     */
    public function testSubscriptions()
    {
        $data = $this->api->subscription->all();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }
}