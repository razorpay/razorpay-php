<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class InvoiceTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testcreate()  // Create Invoice
    {
        $data = $this->api->invoice->create(array ('type' => 'invoice','date' => time(), 'customer_id'=> 'cust_I3et58xEop0LW5', 'line_items'=>array(array("name"=> "Master Cloud Computing in 30 Days", "amount"=>10000, "currency" => "INR", "quantity"=> 1))));
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));
    }


    public function testfetch()  // Fetch all invoices
    {
        $data = $this->api->invoice->fetch('inv_I8fVkyLKcHaxNy');

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));
    }
    
    public function testUpdate() // Update invoice
    {
        $data = $this->api->invoice->fetch('inv_I8fVkyLKcHaxNy')->edit(array('notes' => array('updated-key' => 'An updated note.')));
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));

    }

    public function testInvoiceIssue() // Issue an invoice
    {
        $data = $this->api->invoice->fetch('inv_IByW5p682J3ETc')->issue();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));

    }


    public function testDelete() // Delete an invoice
    {
        $data = $this->api->invoice->fetch('inv_IByVXcsbX79ZZz')->delete();

        $this->assertTrue(is_array($data));

    }

    public function testCancel() // Cancel an invoice
    {
        $data = $this->api->invoice->fetch('inv_IByKpdGB7QxgJs')->cancel();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));

    }

    public function testNotification() // Send notification
    {
        $data = $this->api->invoice->fetch('inv_I8g1jLJxD3Kxm6')->notifyBy('sms');

        $this->assertTrue(in_array('success',$data));

    }
}