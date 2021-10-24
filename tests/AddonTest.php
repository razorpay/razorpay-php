<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class AddonTest extends TestCase
{
    public static $addonId;

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Create an Add-on
     */
    public function testcreate()
    {
        $plan = $this->api->plan->create(array('period' => 'weekly', 'interval' => 1, 'item' => array('name' => 'Test Weekly 1 plan', 'description' => 'Description for the weekly 1 plan', 'amount' => 600, 'currency' => 'INR'),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));  

        $subscription = $this->api->subscription->create(array('plan_id' => $plan->id, 'customer_notify' => 1,'quantity'=>1, 'total_count' => 6, 'addons' => array(array('item' => array('name' => 'Delivery charges', 'amount' => 3000, 'currency' => 'INR'))),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
        
        $data =  $this->api->subscription->fetch($subscription->id)->createAddon(array('item' => array('name' => 'Extra Chair', 'amount' => 3000, 'currency' => 'INR'), 'quantity' => 1));
        
        self::$addonId = $data->id;

        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(is_object($data['item']));
    }
    
    /**
     * Fetch Subscription Link by ID
     */
    public function testFetchId()
    {
        $data = $this->api->addon->fetch(self::$addonId);
        
        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue($data['entity']=='addon');
    }
    
    /**
     * Fetch all addons
     */
    public function testFetchall()
    {
        $data = $this->api->addon->fetchAll();
        
        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(is_array($data['items']));
    }

}