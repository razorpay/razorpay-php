<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class CoverageTest extends TestCase
{
    /**
     * @covers \Razorpay\Api\CustomerTest::create
     * @covers \Razorpay\Api\CustomerTest::edit
     * @covers \Razorpay\Api\CustomerTest::all
     * @covers \Razorpay\Api\CustomerTest::fetch
     */   
    public function testCustomerCoverage(){
      $customer = new CustomerTest();
      $customer->setUp();
      $customer->testCreateCustomer();
      $customer->testEditCustomer();
      $customer->testFetchAll();
      $customer->testFetchCustomer();
    }

}