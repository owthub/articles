<?php
/*
Author: Sanjay Kumar
Email: onlinewebtutorhub@gmail.com 
Method: GET
Description: PHP cURL request to get employees data from fakeapi server.
Website: https://api.onlinewebtutorblog.com/
*/

// Main URL
$request_url = 'https://api.onlinewebtutorblog.com';
// Collection name
$collection_name = "employees";

$url = $request_url . "/" . $collection_name;

$curl = curl_init($url);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_HTTPHEADER, [
    'Content-Type: application/json'
]);

$response = curl_exec($curl);
curl_close($curl);

$data_in_array = json_decode($response, true);

echo "<pre>";
print_r($data_in_array);
