<?php
require_once dirname(__FILE__) . "/../src/MultiSafepay/API/Autoloader.php";
$msp = new MultiSafepay_API_Client;
$msp->setApiKey("4c4054d481b82b79bf21f141ec49a982759b20bb");
$msp->setApiUrl('https://testapi.multisafepay.com/v1/json/'); //set to https://api.multisafepay.com/v1/json/ for live transactions using your live account API key


if (!isset($_POST['issuer'])) {

    $issuers = $msp->issuers->get();

    $issuer_selection = '<select name="issuer">';
    foreach ($issuers as $issuer) {
        $issuer_selection.='<option value="' . $issuer->code . '">' . $issuer->description . '</option>';
    }
    ?><form action="" method="POST">
        <?php echo $issuer_selection; ?>
        <input type="submit" value="Pay Now using iDEAL"/>
    </form>
    <?php
} else {
    try {
        $order_id = time();

        $order = $msp->orders->post(array(
            "type" => "direct",
            "order_id" => $order_id,
            "currency" => "EUR",
            "amount" => 1000,
            "description" => "Demo Transaction",
            "var1" => "1",
            "var2" => "2",
            "var3" => "3",
            "items" => "items list",
            "manual" => "false",
            "gateway" => "IDEAL",
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
            "gateway_info" => array(
                "issuer_id" => $_POST['issuer'],
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
