<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class CoverageTest extends TestCase
{
    /**
     * @covers \Razorpay\Tests\AddonTest::testCreateAddon
     * @covers \Razorpay\Tests\AddonTest::testFetchSubscriptionLink
     * @covers \Razorpay\Tests\AddonTest::testFetchAllAddon
     */
    public function testAddonCoverage(){
      $addon = new AddonTest();
      $addon->setUp();
      $addon->testCreateAddon();
      $addon->testFetchSubscriptionLink();
      $addon->testFetchAllAddon();
    }

    /**
     * @covers \Razorpay\Tests\CustomerTest::testCreateCustomer
     * @covers \Razorpay\Tests\CustomerTest::testEditCustomer
     * @covers \Razorpay\Tests\CustomerTest::testFetchAll
     * @covers \Razorpay\Tests\CustomerTest::testFetchCustomer
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