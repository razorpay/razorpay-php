<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class InvoiceTest extends TestCase
{
    private static $invoiceId ;

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Create Invoice
     */
    public function testcreate()
    {
        $data = $this->api->invoice->create(array ('type' => 'invoice', 'date' => time(), 'customer_id'=> 'cust_I3et58xEop0LW5', 'line_items'=>array(array("name"=> "Master Cloud Computing in 30 Days", "amount"=>10000, "currency" => "INR", "quantity"=> 1))));

        self::$invoiceId = $data->id;

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));
    }

    /**
     * Fetch all invoices
     */
    public function testfetch()
    {

        $data = $this->api->invoice->fetch(self::$invoiceId);

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));
    }
    
    /**
     * Update invoice
     */
    public function testUpdate()
    {
        $data = $this->api->invoice->fetch(self::$invoiceId)->edit(array('notes' => array('updated-key' => 'An updated note.')));
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));

    }
    
    /**
     * Send notification
     */
    public function testNotification()
    {
        $data = $this->api->invoice->fetch(self::$invoiceId)->notifyBy('sms');

        $this->assertTrue(is_array($data));

    }

    /**
     * Issue an invoice
     */
    public function testInvoiceIssue()
    {
        $invoice = $this->api->invoice->create(array ('type' => 'invoice', 'draft'=> true , 'date' => time(), 'customer_id'=> 'cust_I3et58xEop0LW5', 'line_items'=>array(array("name"=> "Master Cloud Computing in 30 Days", "amount"=>10000, "currency" => "INR", "quantity"=> 1))));
        
        $data = $this->api->invoice->fetch($invoice->id)->issue();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));
    
    }

    /**
     * Delete an invoice
     */
    public function testDelete()
    {
        $invoice = $this->api->invoice->create(array ('type' => 'invoice', 'draft'=> true , 'date' => time(), 'customer_id'=> 'cust_I3et58xEop0LW5', 'line_items'=>array(array("name"=> "Master Cloud Computing in 30 Days", "amount"=>10000, "currency" => "INR", "quantity"=> 1))));

        $data = $this->api->invoice->fetch($invoice->id)->delete();

        $this->assertTrue(is_array($data));

    }
    
    /**
     * Cancel an invoice
     */
    public function testCancel()
    {
        $invoice = $this->api->invoice->create(array ('type' => 'invoice', 'draft'=> true , 'date' => time(), 'customer_id'=> 'cust_I3et58xEop0LW5', 'line_items'=>array(array("name"=> "Master Cloud Computing in 30 Days", "amount"=>10000, "currency" => "INR", "quantity"=> 1))));

        $data = $this->api->invoice->fetch($invoice->id)->cancel();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));

    }

}