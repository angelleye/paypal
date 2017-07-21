<?php

require_once('../../../autoload.php');
require_once('../../../includes/config.php');

$configArray = array(
                'ClientID' => $rest_client_id,
                'ClientSecret' => $rest_client_secret
                );

$PayPal = new \angelleye\PayPal\rest\paymentexperience\PaymentExperianceAPI($configArray);

$ProfileID = 'TXP-94995574WU1494357';       // Required. The ID of the profile for which to show details.
// Pass data into class for processing with PayPal and load the response array into $PayPalResult
$PayPalResult = $PayPal->get_web_profile($ProfileID);
// Write the contents of the response array to the screen for demo purposes.
echo "<pre>";
print_r($PayPalResult);

