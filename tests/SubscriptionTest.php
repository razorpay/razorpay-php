<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;

class SubscriptionTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();
    }
    
    public function testcreate()  // Create a Subscription Link
    {
        $data = $this->api->subscription->create(array('plan_id' => 'plan_HuXrfsI0ZZ3peu', 'customer_notify' => 1,'quantity'=>1, 'total_count' => 6, 'addons' => array(array('item' => array('name' => 'Delivery charges', 'amount' => 3000, 'currency' => 'INR'))),'notes'=> array('key1'=> 'value3','key2'=> 'value2')));
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('id',$data->toArray()));
    }
    
    public function testFetchId() // Fetch Subscription Link by ID
    {
        $data = $this->api->subscription->fetch('sub_I3Ett1owwtx89j');
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('plan_id',$data->toArray()));
    }
    
       public function testupdate() // Update a Subscription
       {
           $data = $this->api->subscription->fetch('sub_I3Ett1owwtx89j')->update(array('plan_id'=>'plan_HuXrfsI0ZZ3peu','offer_id'=>'offer_I3FdCGKaLmyToR','schedule_change_at'=>'cycle_end','quantity'=>2));
           
           $this->assertTrue(is_array($data->toArray()));

           $this->assertTrue(in_array('customer_id',$data->toArray()));
       }

       public function testpendingUpdate() // Fetch Details of a Pending Update
       {
         $data = $this->api->subscription->fetch('sub_I3Epz0GoyH6NPc')->pendingUpdate();

         $this->assertTrue(is_array($data->toArray()));

         $this->assertTrue(in_array('id',$data->toArray()));
       }

       public function testCancelUpdate() // Cancel an Update
       {
         $data = $this->api->subscription->fetch('sub_I3Ett1owwtx89j')->cancelScheduledChanges();

         $this->assertTrue(is_array($data->toArray()));

         $this->assertTrue(in_array('id',$data->toArray()));
       }
       
       public function testCancel() // Cancel particular subscription
       {
         $data = $this->api->subscription->fetch('sub_HoxKBd2O0heXfu')->cancel();
         
         $this->assertTrue(is_array($data->toArray()));

         $this->assertTrue(in_array('id',$data->toArray()));
       }
    
       public function testPause() // Pause a Subscription
       {
         $data = $this->api->subscription->fetch('sub_I3Epz0GoyH6NPc')->pause(['pause_at'=>'now']);

         $this->assertTrue(is_array($data->toArray()));

         $this->assertTrue(in_array('id',$data->toArray()));

        $this->assertTrue($data['status'] == 'paused');
       }  
    
    public function testResume() // Resume a Subscription
    {
      $data = $this->api->subscription->fetch('sub_I3Epz0GoyH6NPc')->resume(['resume_at'=>'now']);

      $this->assertTrue(is_array($data->toArray()));

      $this->assertTrue(in_array('id',$data->toArray()));

      $this->assertTrue($data['status'] == 'active');
    } 

    public function testSubscriptionInvoices() // Fetch All Invoices for a Subscription
    {
      $data = $this->api->invoice->all(['subscription_id'=>'sub_HvNIkQUz9I5GBA']);

      $this->assertTrue(is_array($data->toArray()));

      $this->assertTrue(is_array($data['items']));
    } 
    
    public function testDeleteOffer() // Delete an Offer Linked to a Subscription
    {
      $data =  $this->api->subscription->fetch('sub_I3GGEs7Xgmnozy')->deleteOffer('offer_I3FdCGKaLmyToR');

      $this->assertTrue(is_array($data->toArray()));

      $this->assertTrue(in_array('id',$data->toArray()));
    }

    public function testFetchAddons() // Fetch all Add-ons
    {
      $data =  $this->api->addon->fetchAll();

      $this->assertTrue(is_array($data->toArray()));

      $this->assertTrue(is_array($data['items']));
    }

    public function testSubscriptions() // Fetch all subscriptions
    {
        $data = $this->api->subscription->all();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }
}