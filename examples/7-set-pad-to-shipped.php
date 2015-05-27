<?php

require_once dirname(__FILE__) . "/../src/MultiSafepay/API/Autoloader.php";
$msp = new MultiSafepay_API_Client;
$msp->setApiKey("10324b12f0386ab3d9fc4090fcc9545e4f424a80");
$msp->setApiUrl('http://testapi.multisafepay.com/v1/json/');

$transactionid = '1418201532'; //use an uncleared PAD transction order_id
$endpoint = 'orders/' . $transactionid;

try {
    $order = $msp->orders->patch(
            array(
                "tracktrace_code" => "1234tracecode",
                "carrier"=> 'MSPNL',
                "ship_date"=> time(),
                "reason" => 'Shipped'
            ), $endpoint);

if($order->success){
    echo 'Transaction set to Shipped';
}
} catch (MultiSafepay_API_Exception $e) {
    echo "API call failed: " . htmlspecialchars($e->getMessage());
}

