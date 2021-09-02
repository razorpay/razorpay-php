<?php

require('Razorpay.php');

use Razorpay\Api\Api;

$apikey = 'rzp_test_k6uL897VPBz20q';

$secretkey = 'EnLs21M47BllR3X8PSFtjtbd';

$api = new Api($apikey,$secretkey);

// $order  = $api->subscription->fetch('sub_HrkBvbMnwIURVf')->update([
//   //"start_at" => '',
//   //'schedule_change_at'=>'cycle_end'
//   //'plan_id' => 'plan_HoYg68p5kmuvzD'
//   //"offer_id"=>'offer_HrkIvgue2Uneqd'
//   "schedule_change_at"=> "cycle_end",
//   "customer_notify"=>"0"
// ]);

//$order = $api->subscription->fetch('sub_HrkBvbMnwIURVf')->pendingUpdate();

//$order = $api->subscription->fetch('sub_HrkBvbMnwIURVf')->cancelUpdate();

//$order = $api->subscription->fetch('sub_HoxKBd2O0heXfu')->pause();

//$order = $api->subscription->fetch('sub_HoxKBd2O0heXfu')->resume(['resume_at'=>'now']);

//$order = $api->subscription->fetch('sub_HrkBvbMnwIURVf')->deleteOffer('offer_HrkIvgue2Uneqd');

//$order = $api->invoice->subscription('sub_HoZG8bz4l5XHhr');

echo "<pre>"; print_r($order); echo "</pre>";