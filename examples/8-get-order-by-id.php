<?php
require_once dirname(__FILE__) . "/../src/MultiSafepay/API/Autoloader.php";

$msp = new MultiSafepay_API_Client;
$msp->setApiKey("4c4054d481b82b79bf21f141ec49a982759b20bb");
$msp->setApiUrl('https://testapi.multisafepay.com/v1/json/'); //set to https://api.multisafepay.com/v1/json/ for live transactions using your live account API key

?>

<p>This script request the transaction data for 'Connect' transaction with ordernumber: 1413875026</p>

<?php

$transactionid = '1434089539';

//get the order
$order = $msp->orders->get($endpoint = 'transactions', $transactionid, $body=array(), $query_string = false);

echo '<pre>';
print_r($order);
echo '</pre>';




