<?php
require_once dirname(__FILE__) . "/../src/MultiSafepay/API/Autoloader.php";
$msp = new MultiSafepay_API_Client;
$msp->setApiKey("4c4054d481b82b79bf21f141ec49a982759b20bb");
$msp->setApiUrl('https://testapi.multisafepay.com/v1/json/'); //set to https://api.multisafepay.com/v1/json/ for live transactions using your live account API key
//TODO add extra options to get gateway request like locale, country, currency and amount
$query_string = 'country=NL&currency=USD&amount=1000&locale=nl-NL';


$gateways = $msp->gateways->get($endpoint= 'gateways', $type= '', array(), $query_string);


//Create an example gateway selection for forms
$selection= "<select name=\"gateway\">";

foreach($gateways as $gateway)
{
    $selection .= "<option value=\"".$gateway->id."\">".$gateway->description."</option>";
}

$selection .= "</select>";

?><p>Within the source of this script you can see how to request all gateways<br />
as an example a selection is created that can be used inside a form</p><?php
echo $selection;

?>