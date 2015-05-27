<?php
require_once dirname(__FILE__) . "/../src/MultiSafepay/API/Autoloader.php";

$msp = new MultiSafepay_API_Client;
$msp->setApiKey("10324b12f0386ab3d9fc4090fcc9545e4f424a80");
$msp->setApiUrl('http://testapi.multisafepay.com/v1/json/');

?>

<p>This script request the transaction data for 'Connect' transaction with ordernumber: 1413875026</p>

<?php

$transactionid = '1413875026';

//get the order
$order = $msp->orders->get($transactionid);

echo '<pre>';
print_r($order);
echo '</pre>';




