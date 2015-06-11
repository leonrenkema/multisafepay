<?php

require_once dirname(__FILE__) . "/../src/MultiSafepay/API/Autoloader.php";
$msp = new MultiSafepay_API_Client;
$msp->setApiKey("10324b12f0386ab3d9fc4090fcc9545e4f424a80");
$msp->setApiUrl('https://testapi.multisafepay.com/v1/json/'); //set to https://api.multisafepay.com/v1/json/ for live transactions using your live account API key

try {
    $order_id = time();

    $order = $msp->orders->post(array(
        "type" => "direct",
        "order_id" => $order_id,
        "currency" => "EUR",
        "amount" => 2000,
        "description" => "Demo Transaction",
        "var1" => "",
        "var2" => "",
        "var3" => "",
        "items" => "items list",
        "manual" => "false",
        "gateway" => "PAYAFTER",
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
            "zip_code" => "1033 SC",
            "city" => "Amsterdam",
            "state" => "",
            "country" => "NL",
            "phone" => "0208500500",
            "email" => "test@test.nl",
        ),
        "gateway_info" => array(
            "birthday" => "1980-01-30",
            "bank_account" => "2884455",
            "phone" => "0208500500",
            "referrer" => "http://google.nl",
            "user_agent" => "msp01",
            "email" => "test@test.nl"
        ),
        "shopping_cart" => array(
            "items" => array(
                array(
                    "name" => "Test",
                    "description" => "",
                    "unit_price" => "10",
                    "quantity" => "2",
                    "merchant_item_id" => "test123",
                    "tax_table_selector" => "BTW0",
                    "weight" => array(
                        "unit" => "KB",
                        "value" => "20",
                    )
                )
            )
        ),
        "checkout_options" => array(
            "tax_tables" => array(
                "default" => array(
                    "shipping_taxed" => "true",
                    "rate" => "0.21"
                ),
                "alternate" => array(
                    array(
                        "standalone" => "true",
                        "name" => "BTW0",
                        "rules" => array(
                            array("rate" => "0.00")
                        ),
                    )
                )
            )
        ),
        "plugin" => array(
            "shop" => "ideal demo",
            "shop_version" => "1.0.0",
            "plugin_version" => "1.0.1",
            "partner" => "MultiSafepay",
            "shop_root_url" => "http://www.demo.nl",
        )
    ));

    if ($msp->orders->result->success) {
        echo 'Your transaction is completed';
    }
} catch (MultiSafepay_API_Exception $e) {
    echo "Error " . htmlspecialchars($e->getMessage());
}

