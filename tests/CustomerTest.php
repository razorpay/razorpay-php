<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class CustomerTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testcreate()  // Create customer
    {
        $data = $this->api->customer->create(array('name' => 'Razorpay User 12', 'email' => 'customer12@razorpay.com'));
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('customer',$data->toArray()));
    }
    
    public function testedit()  // Edit customer
    {
        $data = $this->api->customer->fetch('cust_I4LnzRjiJYJES7')->edit(array('name' => 'Razorpay User', 'email' => 'customer@razorpay.com','contact'=>'9123456780'));
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('cust_I4LnzRjiJYJES7',$data->toArray()));
    }

    public function testfetchAll()  // Fetch customer All
    {
        $data = $this->api->customer->all();
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }

    public function testfetch()  // Fetch a customer
    {
        $data = $this->api->customer->fetch('cust_I4LnzRjiJYJES7');
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('cust_I4LnzRjiJYJES7',$data->toArray()));
    }
}