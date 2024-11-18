<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class AmountToLowerUnitTest extends TestCase
{   


    public function setUp(): void
    {
        parent::setUp();
    }
    
    /**
     * Two Decimal Currency Amount Coversion
     */
    public function testTwoDecimalAmount()
    {
        $lowerUnitAmount = $this->api->utility->amountToLowerUnit(97.93, 'INR');
        echo 'testTwoDecimalAmount:' . $lowerUnitAmount;
        $this->assertEquals(9793, $lowerUnitAmount);
    }

    /**
     * Three Decimal Currency Amount Coversion
     */
    public function testThreeDecimalAmount()
    {
        $lowerUnitAmount = $this->api->utility->amountToLowerUnit(97.937, 'KWD');
        echo 'testTwoDecimalAmount:' . $lowerUnitAmount;
        $this->assertEquals(97937, $lowerUnitAmount);
    }
    
    /**
     * Zero Decimal Currency Amount Coversion
     */
    public function testZeroDecimalAmount()
    {
        $lowerUnitAmount = $this->api->utility->amountToLowerUnit(973, 'JPY');
        echo 'testTwoDecimalAmount:' . $lowerUnitAmount;
        $this->assertEquals(973, $lowerUnitAmount);
    }


}