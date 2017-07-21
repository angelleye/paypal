<?php
require_once('../../../autoload.php');
require_once('../../../includes/config.php');

$configArray = array(
    'ClientID' => $rest_client_id,
    'ClientSecret' => $rest_client_secret
);
$PayPal = new angelleye\PayPal\rest\billing\BillingAPI($configArray);

$planid = 'PD-66959149NS297950EMTWN2XA';                                  // Required. The ID of the billing plan to update. 

$state = 'ACTIVE';                                   // Allowed values: CREATED, ACTIVE, INACTIVE, and DELETED. Status of the billing plan.

$items = array(
    'op'      => 'replace',                           // Possible values: add, remove, replace, move, copy, test. The operation to perform.
    'path'    => '/',                           // A JSON pointer. References a location in the target document where the operation is performed.
);
$returnArray = $PayPal->update_plan($planid,$items,$state);
echo "<pre>";
print_r($returnArray);
