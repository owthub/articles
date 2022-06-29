<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP How To Install SSL on Subdomain via cPanel API
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/
 
include './xmlapi.php';

// cPanel credentials
$username = "CPANEL_USERNAME";
$password = "CPANEL_PASSWORD";
$cpanelDomain = "CPANEL_DOMAIN_URL"; // sampletuts.com
$domainPort = 2083; // DEFAULT
$sslForDomain = "YOUR SUBDOMAIN"; // xyz.sampletuts.com

// SSL Certificate Keys
$crt1 = "-----BEGIN CERTIFICATE-----
     ********
-----END CERTIFICATE-----";

$key = "-----BEGIN RSA PRIVATE KEY-----
     ********
-----END RSA PRIVATE KEY-----";

$crt2 = "-----BEGIN CERTIFICATE-----
     ********
-----END CERTIFICATE-----
-----BEGIN CERTIFICATE-----
     ********
-----END CERTIFICATE-----
-----BEGIN CERTIFICATE-----
     ********
-----END CERTIFICATE-----";

// cPanel APIs - Authentication
$xmlapi = new \xmlapi($cpanelDomain);
$xmlapi->password_auth($username, $password);
$xmlapi->set_port($domainPort);
$api2args = array();
$result = $xmlapi->api2_query($password, 'CustInfo', 'contactemails', $api2args);
$result = json_decode($result);

// echo "<pre>";
// print_r($result);
// die;

try {
    // Web server certificate SSL Upload
    
    $api2args = array(
        'domain' => $sslForDomain,
        'cert' => $crt1,
        'key' => $key,
        'cabundle' => $crt2,
    );
    $result = $xmlapi->uapi_query($username, 'SSL', 'install_ssl', $api2args);
    $result = json_decode($result);

    echo "<pre>";
    print_r($result);
} catch (ErrorException $ex) {

    echo "<pre>";
    print_r($ex->getMessage());
}
