<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class CustomerTest extends TestCase
{
    private static $customerId;

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Create customer
     */
    public function testcreate()
    {
        $data = $this->api->customer->create(array('name' => 'Razorpay User 38', 'email' => 'customer38@razorpay.com'));

        self::$customerId = $data->id;

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('customer',$data->toArray()));
    }
    
    /**
     * Edit customer
     */
    public function testedit()
    {
        $data = $this->api->customer->fetch(self::$customerId)->edit(array('name' => 'Razorpay User'.time() ,'contact'=>'9123456780'));
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array(self::$customerId, $data->toArray()));
    }

    /**
     * Fetch customer All
     */
    public function testfetchAll()
    {
        $data = $this->api->customer->all();
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }

    /**
     * Fetch a customer
     */
    public function testfetch()
    {
        $data = $this->api->customer->fetch(self::$customerId);
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array(self::$customerId, $data->toArray()));
    }
}