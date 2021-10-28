<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class EmandateTest extends TestCase
{
    private static $customerId;

    private static $invoiceId;

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
     * Create customer
     */
    public function testcreate()
    {
        $data = $this->api->customer->create(array('name' => 'Razorpay User 71', 'email' => 'customer71@razorpay.com', 'contact'=> 9999999999));
        
        self::$customerId = $data->id;

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('customer',$data->toArray()));
    }
    
    /**
     * Create Order
     */
    public function testcreateOrder()
    {
        $data = $this->api->order->create(array('amount' => 100,'currency' => 'INR','method' => 'emandate','customer_id' => self::$customerId,'receipt' => 'Receipt No. '.time(), 'notes' => array('notes_key_1' => 'Beam me up Scotty','notes_key_2' => 'Engage'),'token' => array('auth_type' => 'netbanking','max_amount' => 9999900,'expire_at' => 4102444799,'notes' => array('notes_key_1' => 'Tea, Earl Grey, Hot','notes_key_2' => 'Tea, Earl Grey… decaf.'),'bank_account' => array('beneficiary_name' => 'Gaurav Kumar','account_number' => '1121431121541121','account_type' => 'savings','ifsc_code' => 'HDFC0000001'))));
     
        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(in_array('id',$data->toArray()));
    }

    /**
     * Create registration link
     */
    public function testcreateSubscriptionRegistration()
    {
        $data = $this->api->subscription->createSubscriptionRegistration(array('customer'=>array('name'=>'Gaurav Kumar','email'=>'gaurav.kumar@example.com','contact'=>'7000569565'),'type'=>'link','amount'=>100,'currency'=>'INR','description'=>'Registration Link for Gaurav Kumar','subscription_registration'=>array('method'=>'card','max_amount'=>'500','expire_at'=> strtotime("+1 month") ),'receipt'=>'Receipt No. '.time(),'email_notify'=>1,'sms_notify'=>1,'expire_by'=>strtotime("+1 month"),'notes' => array('note_key 1' => 'Beam me up Scotty','note_key 2' => 'Tea. Earl Gray. Hot.')));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('customer',$data->toArray()));
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
    
    /**
     * Send/Resend notifications
     */
    public function testNotify()
    {
        $data = $this->api->invoice->create(array ('type' => 'invoice', 'date' => time(), 'customer_id'=> self::$customerId, 'line_items'=>array(array("name"=> "Master Cloud Computing in 30 Days", "amount"=>10000, "currency" => "INR", "quantity"=> 1))));
       
        self::$invoiceId = $data->id;

        $data = $this->api->invoice->fetch($data->id)->notifyBy('email');

        $this->assertTrue(is_array($data));

        $this->assertTrue(in_array('success',$data));
            
    }

    /**
     * Cancel a registration link
     */
    public function testCancelRegistrationLink()
    {
        $data = $this->api->invoice->fetch(self::$invoiceId)->cancel();

        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(in_array('id',$data->toArray()));
    }

    /**
     * Fetch token by payment ID
     */
    public function testFetchPaymentById()
    {
       $payment = $this->api->payment->all();

       $data = $this->api->payment->fetch($payment['items'][0]['id']);

       $this->assertTrue(is_array($data->toArray()));

       $this->assertTrue(in_array('id',$data->toArray()));      
    }

    /**
     * Fetch tokens by customer id
     */
    public function testfetchCustomer()
    {
       $data = $this->api->customer->fetch(self::$customerId)->tokens()->all();

       $this->assertTrue(is_array($data->toArray()));
    }

    /**
     * Delete token
     */
    public function testDeleteToken()
    {
       $this->markTestSkipped(); 

       $data = $this->api->customer->fetch($customerId)->tokens()->delete($tokenId);
       
       $this->assertTrue(is_array($data));

       $this->assertTrue(in_array('deleted',$data));
    }

}