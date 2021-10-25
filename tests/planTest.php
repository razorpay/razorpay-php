<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class planTest extends TestCase
{
    private static $planId;

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Create Plan
     */
    public function testcreate()
    {
        $data = $this->api->plan->create(array('period' => 'weekly', 'interval' => 1, 'item' => array('name' => 'Test Weekly 1 plan', 'description' => 'Description for the weekly 1 plan', 'amount' => 600, 'currency' => 'INR'),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));

        self::$planId = $data->id;

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('plan',$data->toArray()));
    }

    /**
     * Fetch all plans
     */
    public function testfetchAll()
    {
        $data = $this->api->plan->all();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }

    /**
     * Fetch particular plan
     */
    public function testfetchPlan()
    {
        $data = $this->api->plan->fetch(self::$planId);

        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(in_array('plan',$data->toArray()));
    } 
}