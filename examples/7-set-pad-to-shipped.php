<?php

require_once dirname(__FILE__) . "/../src/MultiSafepay/API/Autoloader.php";
$msp = new MultiSafepay_API_Client;
$msp->setApiKey("4c4054d481b82b79bf21f141ec49a982759b20bb");
$msp->setApiUrl('https://testapi.multisafepay.com/v1/json/'); //set to https://api.multisafepay.com/v1/json/ for live transactions using your live account API key

$transactionid = '1434089539'; //use an uncleared PAD transction order_id
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

