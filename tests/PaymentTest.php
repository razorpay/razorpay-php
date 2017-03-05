<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class PaymentTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }

    public function testPayments()
    {
        $this->markTestSkipped();

        $data = $this->api->payment->all();

        //
        // $data Should be an associative array
        //
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }
}