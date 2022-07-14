<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;
use Razorpay\Api\Api;

class TransferTest extends TestCase
{
    /**
     * Specify unique transfer id, account id & payment id
     * for example trf_IEn4KYFgfD7q3F, acc_HjVXbtpSCIxENR &
     * pay_I7watngocuEY4P
     */

    private $transferId = "trf_JsxM36hJ4tdt7Z";

    private $accountId = "acc_HSUD5wqmJ0MTDI";

    private $paymentId = "pay_Jsxnbh4vr6TLsA";

    public function setUp()
    {
        parent::setUp();
    }
    
    /**
    * Direct transfers
    */
    public function testDirectTransfer()
    {
        try{
          $data = $this->api->transfer->create(array('account' => $this->accountId, 'amount' => 100, 'currency' => 'INR'));

          $this->assertTrue(is_array($data->toArray()));

          $this->assertTrue(in_array('collection',$data->toArray()));
        }catch(\Exception $e){
          if($e->getMessage()=="This feature is not enabled for this merchant."){
            $this->assertTrue(true);  
          }
        }    
    }

    /**
    * Fetch transfer for a payment
    */
    public function testFetchTransferPayment()
    {
       $data = $this->api->payment->fetch($this->paymentId)->transfers();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('collection',$data->toArray()));
    }

    /**
    * Fetch transfer for an order
    */
    public function testFetchTransferOrder()
    {
        $order = $this->api->order->all();

        if($order['count'] !== 0){

            $data = $this->api->order->fetch($order['items'][0]['id'])->transfers(array('expand[]'=>'transfers'));

            $this->assertTrue(is_array($data->toArray()));

            $this->assertTrue(in_array('order',$data->toArray()));
        }
    }
    
    /**
    * Fetch transfer
    */
    public function testFetchTransfer()
    {
        $data = $this->api->transfer->fetch($this->transferId);

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('order',$data->toArray()));
    }

    /**
    * Fetch transfers for a settlement
    */
    public function testFetchSettlement()
    {
        $settlement = $this->api->transfer->all(array('expand[]'=> 'recipient_settlement'));

        if($settlement['count'] !== 0){

            $data = $this->api->transfer->all(array('recipient_settlement_id'=> $settlement['items'][0]['recipient_settlement_id']));

            $this->assertTrue(is_array($data->toArray()));

        }  
    }

    /**
    * Fetch settlement details
    */
    public function testFetchSettlementDetails()
    {
        $data = $this->api->transfer->all(array('expand[]'=> 'recipient_settlement'));
     
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('collection',$data->toArray()));
          
    }

    /**
    * Fetch payments of a linked account
    */
    public function testFetchPaymentsLinkedAccounts()
    {
        $data = $this->api->payment->all();
    
        $this->assertTrue(is_array($data->toArray()));
    }

    /**
    * Reverse transfers from all linked accounts
    */
    public function testReverseLinkedAccount()
    {
       try{ 
         $transfer = $this->api->transfer->create(array('account' => $this->accountId, 'amount' => 100, 'currency' => 'INR'));

         $data = $this->api->transfer->fetch($transfer->id)->reverse(array('amount'=>100));

         $this->assertTrue(is_array($data->toArray()));
       }catch(\Exception $e){
         if($e->getMessage()=="This feature is not enabled for this merchant."){
            $this->assertTrue(true);
         }
       } 
    }

    /**
    * Hold settlements for transfers
    */
    public function testHoldSettlements()
    {   
        $attributes = json_encode(array('transfers' => array(array('account' => $this->accountId, 'amount' => '100', 'currency' => 'INR', 'on_hold'=>'1'))));

        Request::addHeader('Content-Type', 'application/json');

        $data = $this->api->payment->fetch($this->paymentId)->transfer($attributes);
        
        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('collection',$data->toArray()));
    }

    /**
    * Modify settlement hold for transfers
    */
    public function testModifySettlements()
    {
      try{
        $data = $this->api->transfer->fetch($this->transferId)->edit(array('on_hold'=>1));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('transfer',$data->toArray()));
      }catch(\Exception $e){
         if($e->getMessage()=="No db records found."){
            $this->assertTrue(true);  
         }
      }  
    }

        /**
    * Create transfers from payment
    */
    public function testCreateTransferPayment()
    {
        $attributes = json_encode(array('transfers' => array(array('account'=> $this->accountId, 'amount'=> '100', 'currency'=>'INR', 'notes'=> array('name'=>'Gaurav Kumar', 'roll_no'=>'IEC2011025'), 'linked_account_notes'=>array('branch'), 'on_hold'=>'1', 'on_hold_until'=>'1671222870'))));

        Request::addHeader('Content-Type', 'application/json');
        
        $data = $this->api->payment->fetch($this->paymentId)->transfer($attributes);

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('collection',$data->toArray()));
  
    }

    /**
    * Create transfers from order
    */
     public function testCreateTransferOrder()
    {
        $attributes = json_encode(array('amount' => 100,'currency' => 'INR','transfers' => array(array('account' =>$this->accountId,'amount' => 100,'currency' => 'INR','notes' => array('branch' => 'Acme Corp Bangalore North','name' => 'Gaurav Kumar'),'linked_account_notes' => array('branch'),'on_hold' => 1,'on_hold_until' => 1671222870))));

        Request::addHeader('Content-Type', 'application/json');

        $data = $this->api->order->create($attributes);

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('transfer',$data->toArray()));
    }
}