<?php
require_once('../../../autoload.php');
require_once('../../../includes/config.php');

$configArray = array(
    'ClientID' => $rest_client_id,
    'ClientSecret' => $rest_client_secret
);

$PayPal = new angelleye\PayPal\rest\payments\PaymentAPI($configArray);

$authorizationId='';                  //The Authorization ID of the payment.
$amount = array(
    'Currency' => '',                                       //Required. 3-letter [currency code](https://developer.paypal.com/docs/integration/direct/rest_api_payment_country_currency_support/). PayPal does not support all currencies. 
    'Total'    => '',                                         //Required. Total amount charged from the payer to the payee. In case of a refund, this is the refunded amount to the original payer from the payee. 10 characters max with support for 2 decimal places. 
);

$returnArray = $PayPal->authorization_capture($authorizationId,$amount);
echo "<pre>";
var_dump($returnArray);
