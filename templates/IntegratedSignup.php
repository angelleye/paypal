<?php
if(!session_id()) session_start();

require_once('../includes/config.php');
require_once('../autoload.php');

$configArray = array(
    'ClientID' => $rest_client_id,
    'ClientSecret' => $rest_client_secret,
    'Sandbox' => $sandbox,
    'PrintHeaders' => $print_headers, 
    'LogResults' => $log_results, 
    'LogPath' => $log_path
);

$PayPal = new angelleye\PayPal\PayPal_IntegratedSignup($configArray);

$customer_data = array();
$customer_data['customer_type'] = '';                // Type of account to create. Valid value: MERCHANT (creates PayPal business account).

$person_details = array();                          // Contains information on the person who will be responsible for the PayPal account.

$person_details['email_address'] = '';              // Primary email address for the PayPal account.

$name = array(
    "prefix" => '',                                 // The prefix of the account holder’s name (such as “Mr.”,“Mrs.”, “Dr.”, etc). Maximum length: 140 characters  
    "given_name" => '',                             // Account holder’s first name or given name.Maximum length: 140 characters.
    "surname" => '',                                // Account holder’s last name, family name, surname, or matronymic name. Maximum length: 140 characters.
    "middle_name" => '',                            // Account holder’s middle name or patronymic name.Maximum length: 140 characters
    "suffix"    => '',                              // The suffix of the account holder’s name (such as “Jr.”,“Sr.”, “II”, “III”, etc).Maximum length: 140 characters
    "alternate_full_name" => ''                     // Account holder’s full name or business name. Can be used when the account holder’s name cannot be broken into separate parts, or when the business does not provide the name of the account holder.Maximum length: 300 characters
);
$person_details['name'] = $name;

$phone_contacts = array();
$phone_number_details = array(
    "country_code" => '',                           // The phone number’s country code, as defined by E.164.Only numeric characters are allowed in this field.
    "national_number" => '',                       // The phone number.Only numeric characters are allowed in this field.
    "extension_number" => ''                       // The extension number. Only numeric characters are allowed in this field.
);
$phone_contacts['phone_number_details']= $phone_number_details;

$phone_contacts['phone_type'] = '';                // The phone number type.Valid values: FAX,HOME,MOBILE,OTHER,PAGER.
$person_details['phone_contacts'][0] = $phone_contacts;

$home_address = array(
    "city" => '',                                   // City name.Maximum length: 300 characters.
    "country_code" => '',                          // Country code.
    "line1" => '',                                // First line of street address. Maximum length: 300 characters.
    "line2" => '',                               // Second line of street address. Maximum length: 300 characters.   
    "postal_code" => '',                        // ZIP code or postal code.Maximum length: 64 characters.
    "state" => ''                              // State or province name. For US addresses, this should be the 2-character state abbreviation. Maximum length: 300 characters.
);
$person_details['home_address'] = $home_address;

$date_of_birth = array(
    "event_date" => '',                        // The date/time of the event, specified in ISO 8601 format.
    "event_type" => ''                        // The type of event indicated by the date.Valid values: BIRTH, ESTABLISHED, INCORPORATION, OPERATION.
);
$person_details['date_of_birth'] = $date_of_birth;

$person_details['nationality_country_code'] = '';        // The account holder’s nationality.

$identity_documents = array(    // Contains information on the merchant’s identifying documents.
    "type" => '',               // The document type. Valid values: SOCIAL_SECURITY_NUMBER,EMPLOYMENT_IDENTIFICATION_NUMBER,TAX_IDENTIFICATION_NUMBER,PASSPORT_NUMBER,PENSION_FUND_ID,MEDICAL_INSURANCE_ID.
    "value" => '',              // The number of the identity document. Only alphanumeric characters are allowed in this field.
    "partial_value" => '',      // Indicates whether the value contains a partial value. This field should be set to true where the identity document supports partial values, such as the last four digits of a social security number.
    "issuer_country_code" => '' // The country where the identity document was issued.
);                  

$person_details['identity_documents'] = $identity_documents;

/*Business details start */

$business_details = array();

$phone_contacts = array();                                  // Contains information on the account holder’s phone number(s).
$phone_number_details = array(
    "country_code" => '',                                // The phone number’s country code, as defined by E.164.Only numeric characters are allowed in this field.
    "national_number" => '',                             // The phone number.Only numeric characters are allowed in this field.
    "extension_number" => ''                             // The extension number. Only numeric characters are allowed in this field.
);
$phone_contacts['phone_number_details'] = $phone_number_details;
$phone_contacts['phone_type'] = '';                // The phone number type.Valid values: FAX,HOME,MOBILE,OTHER,PAGER.
$business_details['phone_contacts'][0] = $phone_contacts;

$business_address = array(    
   "city" => '',                                  // City name.Maximum length: 300 characters.
   "country_code" => '',                         // Country code.
   "line1" => '',                               // First line of street address.Maximum length: 300 characters.
   "line2" => '',                             // Second line of street address. Maximum length: 300 characters.  
   "postal_code" => '',                      // ZIP code or postal code.Maximum length: 64 characters.
   "state" => ''                            // State or province name. For US addresses, this should be the 2-character state abbreviation. Maximum length: 300 characters.
);
$business_details['business_address'] = $business_address;

$business_details['business_type'] = '';                  // The business type.Valid values: INDIVIDUAL,PROPRIETORSHIP,PARTNERSHIP,CORPORATION,NONPROFIT,GOVERNMENT,PUBLIC_COMPANY,REGISTERED_COOPERATIVE,PROPRIETARY_COMPANY,ASSOCIATION,PRIVATE_CORPORATION,LIMITED_PARTNERSHIP,LIMITED_LIABILITY_PROPRIETORS,LIMITED_LIABILITY_PARTNERSHIP,PUBLIC_CORPORATION,OTHER_PUBLIC_BODY.
$business_details['category'] = '';      
$business_details['sub_category'] = '';                  // Business subcategory.
$names = array(
   "name" => '',                                         // The name of the business.
   "type" => ''                                         //  Name type.Valid values:LEGAL, DOING_BUSINESS_AS, STOCK_TRADING_NAME.  
);
$business_details['names'][0] = $names;
$event_dates = array(
     "event_date" => '',                                // The date/time of the event, specified in ISO 8601 format.
     "event_type" => ''                                //  The type of event indicated by the date. Valid values: BIRTH,ESTABLISHED,INCORPORATION,OPERATION.
);
$business_details['event_dates'][0] = $event_dates;

$website_urls = '';
$business_details['website_urls'][0] = $website_urls;

$annual_sales_volume_range = array();               // The merchant’s annual sales volume.
$maximum_amount = array(
    "currency" => '',                              // The currency of the amount.
    "value" => ''                                 // The currency amount. 
);
$minimum_amount = array(
    "currency" => '',                            // The currency of the amount.
    "value" => ''                               // The currency amount. 
);
$annual_sales_volume_range['maximum_amount']= $maximum_amount;
$annual_sales_volume_range['minimum_amount']= $minimum_amount;
$business_details['annual_sales_volume_range'] = $annual_sales_volume_range;


$average_monthly_volume_range = array();          //The merchant’s average monthly sales volume.
$maximum_amount = array(
     "currency" => '',                           // The currency of the amount.
     "value" => ''                              // The currency amount.
);
$minimum_amount = array(
     "currency" => '',                         // The currency of the amount.
     "value" => ''                            // The currency amount.
);
$average_monthly_volume_range['maximum_amount'] = $maximum_amount;
$average_monthly_volume_range['minimum_amount'] = $minimum_amount;
$business_details['average_monthly_volume_range'] = $average_monthly_volume_range;

$identity_documents = array(
    "issuer_country_code" => '',                          // The country where the identity document was issued.
    "partial_value" => '',                               // Indicates whether the value contains a partial value.This field should be set to true where the identity document supports partial values, such as the last four digits of a social security number.
    "type" => '',                                       // The document type.Valid values:SOCIAL_SECURITY_NUMBER, EMPLOYMENT_IDENTIFICATION_NUMBER, TAX_IDENTIFICATION_NUMBER, PASSPORT_NUMBER, PENSION_FUND_ID, MEDICAL_INSURANCE_ID.
    "value" => ''                                      // The number of the identity document. Only alphanumeric characters are allowed in this field.
);
$business_details['identity_documents'][0] = $identity_documents;


$email_contacts = array(
     "email_address" => '',                            // The email address.
     "role" => ''                                     // The role of this email address. Valid values: CUSTOMER_SERVICE (indicates that this email address will be displayed to buyers, instead of the primary email address on the PayPal account).
 );
 $business_details['email_contacts'][0] = $email_contacts;
 
$customer_data['person_details'] = $person_details;
$customer_data['business_details'] = $business_details;
$customer_data['preferred_language_code'] = '';             // The user’s preferred language.
$customer_data['primary_currency_code'] = '';              // The user’s primary currency.

$referral_user_payer_id = array(
    "type" => '',                                        // PayPal account identifier type. Valid values: PAYER_ID
    "value" => '',                                      // PayPal account identifier
);
$customer_data['referral_user_payer_id'] = $referral_user_payer_id;

$partner_specific_identifiers = array(
    "type" => '',                                    // (Required) Type of partner identifier.Valid values: TRACKING_ID.
    "value" => ''                                   // Partner identifier. The partner identifier is a value for your own use in tracking the merchant and will be returned to you when the merchant is redirected back to your site from PayPal. Only alphanumeric characters are allowed in this field.
);
$customer_data['partner_specific_identifiers'][0] = $partner_specific_identifiers;

$requested_capabilities = array();         // Contains information on the capabilities, including specifics of API provisioning, that is being requested for the new account.

$api_integration_preference = array();     // Contains information on the API integration to be performed with the partner.
$api_integration_preference['classic_api_integration_type'] = '';             // The type of integration that will be performed with the partner. Valid values: THIRD_PARTY (indicates that third party permissions are to be granted from the merchant to the partner), FIRST_PARTY_INTEGRATED (indicates that first party API credentials are to be obtained from the merchant), FIRST_PARTY_NON_INTEGRATED (indicates that first party API credentials are to be generated and displayed to the merchant at the end of the signup flow).

$classic_third_party_details = array();     // Contains information on the third party permissions that are to be granted to the partner. Only valid when classic_api_integration_type is set to THIRD_PARTY.
$permission_list = array(
    "0" => '',                         // provides access to the SetExpressCheckout, GetExpressCheckoutDetails, DoExpressCheckoutPayment, and GetPalDetails APIs.
    "1" => '',                        // provides access to the Refund and RefundTransaction APIs.
    "2" => '',                       // provides access to the DoAuthorization,DoCapture, DoReauthorization, and DoVoid APIs.
    "3" => '',                      // provides access to the GetTransactionDetails API.
    "4" => '',                     // provides access to the TransactionSearch API.
    "5" => ''                     // provides access to the BillAgreementUpdate and DoReferenceTransaction APIs.
);
/* $classic_first_party_details = array(); 
 * classic_first_party_details
 * Indicates whether API credentials generated for the merchant
   should contain an API signature or an API certificate. Only valid
   when classic_api_integration_type is set to FIRST_PARTY_INTEGRATED
   or FIRST_PARTY_NON_INTEGRATED.
 * 
$api_integration_preference['classic_api_integration_type'] = 'FIRST_PARTY_INTEGRATED';
$api_integration_preference['classic_first_party_details'] = 'SIGNATURE';  // Valid values: SIGNATURE (indicates that API credentials generated for the merchant should contain an API signature) CERTIFICATE (indicates that API credentials generated for the merchant should contain an API certificate)
*/
$classic_third_party_details['permission_list'] = $permission_list;  
$api_integration_preference['classic_third_party_details'] = $classic_third_party_details;  // Contains information on the third party permissions that are to be granted to the partner. Only valid when classic_api_integration_type is set to THIRD_PARTY
$api_integration_preference['partner_id'] = '';                // Payer ID of the partner with whom the merchant will integrate. This will generally be your payer ID.
$requested_capabilities['api_integration_preference'] = $api_integration_preference;  
$requested_capabilities['capability'] = '';                // Describes the capability being requested. Valid values: API_INTEGRATION.

$web_experience_preference = array(
    "action_renewal_url" => '',                           // URL where the merchant will be returned to in the event that the token (issued by this call) has expired.
    "partner_logo_url" => '',                            // URL of an image which will be displayed to the merchant during the signup flow. This allows you to co-brand the signup pages with your logo.
    "return_url" => ''    // URL where the merchant will be returned to after they complete the signup flow on PayPal.
);
$collected_consents = array(
    "granted" => '',                                //Indicates whether consent was obtained. If set to false, PayPal will ignore all of the data passed in the customer_data top-level object.
    "type" => ''                                     //Indicates the type of consent obtained from the merchant. Valid values: SHARE_DATA_CONSENT (indicates that you have obtained consent from the merchant to share their data with PayPal).
);
$products = array(
    "0" => ''                                       // Indicates which PayPal products the merchant should be enrolled in. Valid values: EXPRESS_CHECKOUT.
);
$requestData = array();
$requestData['collected_consents'][0] = $collected_consents;
$requestData['customer_data'] = $customer_data;
$requestData['products'] = $products;
$requestData['requested_capabilities'][0] = $requested_capabilities;
$requestData['web_experience_preference'] = $web_experience_preference;

$responseData = $PayPal->IntegratedSignup($requestData);

echo "<pre>";
print_r($responseData);
exit;

