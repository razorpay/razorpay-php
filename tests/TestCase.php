<?php

namespace Razorpay\Tests;

use Razorpay\Api\Api;
use Razorpay\Api\Request;

class TestCase extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
        $this->api = new Api($_SERVER['KEY_ID'], $_SERVER['KEY_SECRET']);
    }
}