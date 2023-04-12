<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class CoverageTest extends TestCase
{
    /**
     * @covers \Razorpay\Api\Addon::fetch
     * @covers \Razorpay\Api\Addon::fetchAll
     */
    public function testAddonCoverage(){
      $addon = new AddonTest();
      $addon->setUp();
      $addon->testFetchSubscriptionLink();
      $addon->testFetchAllAddon();
    }

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

    /**
     * @covers \Razorpay\Api\Card::fetch
     */   
    public function testCardCoverage(){
      $card = new CardTest();
      $card->setup();
      $card->testFetchCard();
    }

    /**
     * @covers \Razorpay\Api\FundAccount::create
     * @covers \Razorpay\Api\FundAccount::all
     */
    public function testFundCoverage(){
      $fund = new FundTest();
      $fund->setup();
      $fund->testCreateFundAccount();
      $fund->testCreateOrder();
    }

      /**
       * @covers \Razorpay\Api\Invoice::create
       * @covers \Razorpay\Api\Invoice::all
       * @covers \Razorpay\Api\Invoice::edit
       * @covers \Razorpay\Api\Invoice::notifyBy
       * @covers \Razorpay\Api\Invoice::delete
       * @covers \Razorpay\Api\Invoice::cancel
       * @uses \Razorpay\Api\Invoice::fetch
       */
      public function testInvoiceCoverage(){
        $invoice = new InvoiceTest();
        $invoice->setup();
        $invoice->testCreateInvoice();
        $invoice->testFetchAllInvoice();
        $invoice->testUpdateInvoice();
        $invoice->testInvoiceIssue();
        $invoice->testDeleteInvoice();
        $invoice->testCancelInvoice();
      }   
}