<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class paperNachTest extends TestCase
{
    private static $invoiceId;

    private static $orderId;

    private static $customerId;

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Create customer
     */
    public function testcreate()
    {
        $data = $this->api->customer->create(array('name' => 'Razorpay User 65', 'email' => 'customer65@razorpay.com'));
        
        self::$customerId = $data->id;

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('customer',$data->toArray()));
    }

    /**
     * Create order
     */
    public function testcreateOrder()
    {
        $data = $this->api->order->create(array('receipt' => '123', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));

        self::$orderId = $data->id;

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('id',$data->toArray()));
    }
    
    /**
     * Send notification
     */
    public function testNotification()
    {
        $invoice = $this->api->invoice->create(array ('type' => 'invoice', 'date' => time(), 'customer_id'=> self::$customerId, 'line_items'=>array(array("name"=> "Master Cloud Computing in 30 Days", "amount"=>10000, "currency" => "INR", "quantity"=> 1))));

        $data = $this->api->invoice->fetch($invoice->id)->notifyBy('email');

        self::$invoiceId = $invoice->id ;

        $this->assertTrue(in_array('success',$data));

    }
    
    /**
     * Cancel an invoice
     */
    public function testInvoiceCancel()
    {
        $data = $this->api->invoice->fetch(self::$invoiceId)->cancel();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('invoice_number',$data->toArray()));

    }

    /**
     * Create registration link
     */
    public function testRegistrationLink()
    {
        $data = $this->api->subscription->createSubscriptionRegistration(array('customer' => array('name' => 'Gaurav Kumar','email' => 'gaurav.kumar@example.com','contact' => '9123456780'),'amount' => 0,'currency' => 'INR','type' => 'link','description' => '12 p.m. Meals','subscription_registration' => array('method' => 'nach','auth_type' => 'physical','bank_account' => array('beneficiary_name' => 'Gaurav Kumar','account_number' => '11214311215411','account_type' => 'savings','ifsc_code' => 'HDFC0001233'),'nach' => array('form_reference1' => 'Recurring Payment for Gaurav Kumar','form_reference2' => 'Method Paper NACH'),'expire_at' => 1636772800,'max_amount' => 50000),'receipt' => 'Receipt No. '.time(),'sms_notify' => 1,'email_notify' => 1,'expire_by' => 1636772800,'notes' => array('note_key 1' => 'Beam me up Scotty','note_key 2' => 'Tea. Earl Gray. Hot.')));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('id',$data->toArray()));
    }

    /**
     * Fetch Payment ID using Order ID
     */
    public function testfetchPayment()
    {
        $data = $this->api->order->fetch(self::$orderId)->payments();

        $this->assertTrue(is_array($data->toArray()));

    }

    /**
     * Fetch token by payment ID
     */
    public function testfetchToken()
    {
        $payment = $this->api->payment->all();

        if(!empty($payment)){

            $data = $this->api->payment->fetch($payment['items'][0]['id']);

            $this->assertTrue(is_array($data->toArray()));

            $this->assertTrue(in_array('id',$data->toArray()));
        }
    }

    /**
     * Delete token
     */
    public function testDeleteToken()
    {
       
       $this->markTestSkipped(); 

       $data = $this->api->customer->fetch('cust_HzoFfk52EjwayH')->tokens()->delete('token_HzoewrD4ZIvhVM');

       $this->assertTrue(is_array($data));

       $this->assertTrue(in_array('deleted',$data));
    }

    /**
     * Create an order to charge the customer
     */
    public function testCreateOrderToCustomer()
    {
        $data = $this->api->order->create(array('receipt' => '122', 'amount' => 100, 'currency' => 'INR', 'notes'=> array('key1'=> 'value3','key2'=> 'value2')));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('id',$data->toArray()));
    }
    
    /**
     * Create a Recurring Payment
     */
    public function testCreateRecurring()
    {
        $this->markTestSkipped(); 
        
        $data = $this->api->payment->createRecurring(array('email'=>'gaurav.kumar@example.com','contact'=>'9123456789','amount'=>100,'currency'=>'INR','order_id'=>'order_I80LnO03SgjIzD','customer_id'=>'cust_HzoFfk52EjwayH','token'=>'token_I80QtqvWJrTzSl','recurring'=>'1','description'=>'Creating recurring payment for Gaurav Kumar'));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('razorpay_payment_id',$data->toArray()));
    }

}