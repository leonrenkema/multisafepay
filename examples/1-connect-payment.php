<?php

require_once dirname(__FILE__) . "/../src/MultiSafepay/API/Autoloader.php";

$msp = new MultiSafepay_API_Client;
$msp->setApiKey("10324b12f0386ab3d9fc4090fcc9545e4f424a80");
$msp->setApiUrl('https://testapi.multisafepay.com/v1/json/'); //set to https://api.multisafepay.com/v1/json/ for live transactions using your live account API key
try {
    $order_id = time();

    $order = $msp->orders->post(array(
        "type" => "redirect",
        "order_id" => $order_id,
        "currency" => "EUR",
        "amount" => 1000,
        "description" => "Demo Transaction",
        "var1" => "1",
        "var2" => "2",
        "var3" => "3",
        "items" => "items list",
        "manual" => "false",
        "gateway" => "",
        "days_active" => "30",
        "payment_options" => array(
            "notification_url" => "http://www.notification.url",
            "redirect_url" => "http://www.redirect.url",
            "cancel_url" => "http://www.cancel.url",
            "close_window" => "true"
        ),
        "customer" => array(
            "locale" => "nl_NL",
            "ip_address" => "127.0.0.1",
            "forwarded_ip" => "127.0.0.1",
            "first_name" => "Jan",
            "last_name" => "Modaal",
            "address1" => "Kraanspoor",
            "address2" => "",
            "house_number" => "39",
            "zip_code" => "1032 SC",
            "city" => "Amsterdam",
            "state" => "",
            "country" => "NL",
            "phone" => "0208500500",
            "email" => "test@test.nl",
        ),
        "google_analytics" => array(
            "account" => "UA-XXXXXXXXX",
        ),
        "plugin" => array(
            "shop" => "ideal demo",
            "shop_version" => "1.0.0",
            "plugin_version" => "1.0.1",
            "partner" => "MultiSafepay",
            "shop_root_url" => "http://www.demo.nl",
        ),
        "custom_info" => array(
            "custom_1" => "value1",
            "custom_2" => "value2",
        )
    ));

    header("Location: " . $msp->orders->getPaymentLink());
} catch (MultiSafepay_API_Exception $e) {
    echo "Error " . htmlspecialchars($e->getMessage());
}

