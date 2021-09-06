<?php

$razorpayPaymentId = "pay_HuAPScv9dwGP4N"; // returned by checkout
$razorpaySignature = "1c789d0c2279a0670b44b54613180d9ef0f43ce723adeaec3dadb5fe4284579f"; // returned by checkout
$subscriptionId = "sub_00000000000001"; 
$keysecret = "key_secret";

$expectedSignature = hash_hmac('sha256', $razorpayPaymentId . '|' . $subscriptionId, $keysecret);

if ($expectedSignature === $razorpaySignature)
{
    echo "Payment is successful!";
}

