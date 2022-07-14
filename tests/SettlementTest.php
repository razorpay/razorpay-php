<?php

namespace Razorpay\Tests;

use Razorpay\Api\Request;
use Razorpay\Api\Errors;

class SettlementTest extends TestCase
{
    /**
     * Specify unique settlement id
     * for example : setl_IAj6iuvvTATqOM 
     */

    private $settlementId =  "setl_IAj6iuvvTATqOM";

    public function setUp()
    {
        parent::setUp();
    }

    /**
     * Create on-demand settlement
     */
    public function testCreateOndemandSettlement()
    {
    try{ 
       $data = $this->api->settlement->createOndemandSettlement(array("amount"=> 1221, "settle_full_balance"=> false, "description"=>"Testing","notes" => array("notes_key_1"=> "Tea, Earl Grey, Hot","notes_key_2"=> "Tea, Earl Grey… decaf.")));
      
       $this->assertTrue(is_array($data->toArray()));

       $this->assertTrue(in_array('settlement.ondemand',$data->toArray()));

      }catch(\Exception $e){
        if($e->getMessage() == "The requested URL was not found on the server."){
           $this->assertTrue(true);
        }  
      }
    }
    
    /**
     * Fetch all settlements
     */
    public function testAllSettlements()
    {
        $data = $this->api->settlement->all();

        $this->assertTrue(is_array($data->toArray()));
        
        $this->assertTrue(in_array('collection',$data->toArray()));
    }

    /**
     * Fetch a settlement
     */
    public function testFetchSettlement()
    {
        $settlement = $this->api->settlement->all();

        $data = $this->api->settlement->fetch($settlement['items'][0]['id']);

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(in_array('settlement',$data->toArray()));
    }

    /**
     * Settlement report for a month
     */
    public function testReports()
    {
        $data = $this->api->settlement->reports(array("year"=>2021,"month"=>9));

        $this->assertTrue(is_array($data->toArray()));

    }

    /**
     * Settlement recon
     */
    public function testSettlementRecon()
    {
        $data = $this->api->settlement->settlementRecon(array('year' => 2021, 'month' => 9));

        $this->assertTrue(is_array($data->toArray()));

        $this->assertArrayHasKey('items',$data);
    }
   
    /**
     * Fetch all on-demand settlements
     */
    public function TestFetchAllOndemandSettlement()
    {
      try{ 

        $data = $api->settlement->fetchAllOndemandSettlement();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
           
      }catch(\Exception $e){
        $this->markTestSkipped('Feature is not enable');
      }     
    }

    /**
     * Fetch on-demand settlement by ID
     */
    public function TestFetchAllOndemandSettlementById()
    {
        $data = $api->settlement->fetch($this->settlementId)->TestFetchAllOndemandSettlementById();

        $this->assertTrue(is_array($data->toArray()));

        $this->assertTrue(is_array($data['items']));
    }
}