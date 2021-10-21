<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class fundTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testcreate()  // Create a fund account
    {
        $data = $this->api->fundAccount->create(array('customer_id'=>'cust_I4N2k08mCtNY3J','account_type'=>'bank_account','bank_account'=>array('name'=>'Gaurav Kumar', 'account_number'=>'11214311215411', 'ifsc'=>'HDFC0000053')));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('customer_id',$data->toArray()));
    }
    
    public function testcreateOrder()  // Fetch all fund accounts
    {
        $data = $this->api->fundAccount->all(array('customer_id'=>'cust_I81h82POhaxi7z'));

        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(in_array('customer_id',$data->toArray()));
    }

}