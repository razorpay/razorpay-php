<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class OrdersTest extends TestCase
{
    private static $orderId;

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Create order
     */
    public function testcreate()
    {
        $data = $this->api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));

        self::$orderId = $data->id;

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('id',$data->toArray()));
    }

    /**
     * Fetch all orders
     */
    public function testAll()
    {
        $data = $this->api->order->all();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }
    
    /**
     * Fetch particular order
     */
    public function testfetch()
    {
        $data = $this->api->order->fetch(self::$orderId);

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('order',$data->toArray()));
    }

    /**
     * Fetch payments for an order
     */
    public function testfetchById()
    {
        $data = $this->api->order->fetch(self::$orderId)->payments();

        $this->assertTrue(is_array($data->toArray()));

    }
    
    /**
     * Update Order
     */
    public function testUpdate()
    {
        $data = $this->api->order->fetch(self::$orderId)->edit(array('notes'=> array('notes_key_1'=>'Beam me up Scotty. 1', 'notes_key_2'=>'Engage')));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('entitiy',$data->toArray()));

    }
}