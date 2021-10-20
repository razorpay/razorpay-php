<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class OrdersTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testcreate()  // Create order
    {
        $data = $this->api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('id',$data->toArray()));
    }


    public function testAll()  // Fetch all orders
    {
        $data = $this->api->order->all();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }
    
    public function testfetch()  // Fetch particular order
    {
        $data = $this->api->order->fetch('order_I80LnO03SgjIzD');

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('order',$data->toArray()));
    }

    public function testfetchById()  // Fetch payments for an order
    {
        $data = $this->api->order->fetch('order_I80LnO03SgjIzD')->payments();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }
    
    public function testUpdate() // Update Order
    {
        $data = $this->api->order->fetch('order_I80LnO03SgjIzD')->edit(array('notes'=> array('notes_key_1'=>'Beam me up Scotty. 1', 'notes_key_2'=>'Engage')));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('entitiy',$data->toArray()));

    }
}