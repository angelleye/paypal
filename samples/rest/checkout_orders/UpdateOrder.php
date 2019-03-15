<?php

use \angelleye\PayPal\rest\checkout_orders\CheckoutOrdersAPI;

// Include required library files.
require_once('../../../autoload.php');
require_once('../../../includes/config.php');

$configArray = array(
    'ClientID' => $rest_client_id,
    'ClientSecret' => $rest_client_secret,
    'LogResults' => $log_results,
    'LogPath' => $log_path,
    'LogLevel' => $log_level
);

$PayPal = new CheckoutOrdersAPI($configArray);

$order_id = '1LM425079H915583E';

$array = array(
    "op" => "replace",
    "path" => "/purchase_units/@reference_id=='default'/amount",
    "value" => array(
        'currency_code' => 'USD',
        'value' => '10.00',
        'breakdown' => array(
            'item_total' => array(
                'value' => '8.00',
                'currency_code' => 'USD',
            ),
            'shipping' => array(
                'value' => '2.00',
                'currency_code' => 'USD',
            )
        )
    )
);

$returnArray = $PayPal->UpdateOrder($order_id,$array);
echo "<pre>";
print_r($returnArray);
exit;