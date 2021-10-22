<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class fundTest extends TestCase
{
    private static $customerId;

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Create a fund account
     */
    public function testcreate()
    {
        $customer = $this->api->customer->create(array('name' => 'Razorpay User 34', 'email' => 'customer34@razorpay.com'));

        $data = $this->api->fundAccount->create(array('customer_id'=>$customer->id,'account_type'=>'bank_account','bank_account'=>array('name'=>'Gaurav Kumar', 'account_number'=>'11214311215411', 'ifsc'=>'HDFC0000053')));

        self::$customerId = $customer->id;

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('customer_id',$data->toArray()));
    }
    
    /**
     * Fetch all fund accounts
     */
    public function testcreateOrder()
    {
        $data = $this->api->fundAccount->all(array('customer_id'=>self::$customerId));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }

}