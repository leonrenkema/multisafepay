<?php

require_once dirname(__FILE__) . "/../src/MultiSafepay/API/Autoloader.php";
define('BASE_URL', ($_SERVER['SERVER_PORT'] == 443 ? 'https://' : 'http://') . $_SERVER['SERVER_NAME'] . ':' . $_SERVER['SERVER_PORT'] . dirname($_SERVER['SCRIPT_NAME']) . "/");

$msp = new MultiSafepay_API_Client;
$msp->setApiKey("10324b12f0386ab3d9fc4090fcc9545e4f424a80");
$msp->setApiUrl('http://testapi.multisafepay.com/v1/json/');


if (isset($_GET['type'])) {
    ?>
    <p>Your transaction was processed, if the status was completed then the transaction was refunded when you reached this page and you don't see an error</p>
    <?php

    $transactionid = $_GET['transactionid'];

    //get the order status
    $order = $msp->orders->get($transactionid);

    if ($order->ewallet->status == "completed") {
        //the transaction status was competed, now we will refund the transaction
        $endpoint = 'orders/' . $transactionid . '/refunds';
        try {
            $order = $msp->orders->post(array(
                "type" => "refund",
                "amount" => "20",
                "currency" => "EUR",
                "description" => "Json refund",
                    ), $endpoint);
        } catch (MultiSafepay_API_Exception $e) {
            echo "Error " . htmlspecialchars($e->getMessage());
        }
    }
} else {
    try {
        $order_id = time();

        $order = $msp->orders->post(array(
            "type" => "redirect",
            "order_id" => $order_id,
            "currency" => "EUR",
            "amount" => 1000,
            "description" => "Demo Transaction",
            "var1" => "",
            "var2" => "",
            "var3" => "",
            "items" => "items list",
            "manual" => "false",
            "gateway" => "",
            "days_active" => "30",
            "payment_options" => array(
                "notification_url" => "http://www.notification.url",
                "redirect_url" => BASE_URL . "4-transaction-and-refund.php?type=redirect",
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
            )
        ));

        header("Location: " . $msp->orders->getPaymentLink());
    } catch (MultiSafepay_API_Exception $e) {
        echo "Error " . htmlspecialchars($e->getMessage());
    }
}

    