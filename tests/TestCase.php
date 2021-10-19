<?php

namespace Razorpay\Tests;

use Razorpay\Api\Api;
use Razorpay\Api\Request;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->api = new Api('rzp_test_k6uL897VPBz20q', 'EnLs21M47BllR3X8PSFtjtbd');
    }
}