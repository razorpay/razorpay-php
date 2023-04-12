<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class CoverageTest extends TestCase
{
    /**
     * @covers \Razorpay\Api\Customer::create
     * @covers \Razorpay\Api\Customer::edit
     * @covers \Razorpay\Api\Customer::all
     * @covers \Razorpay\Api\Customer::fetch
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