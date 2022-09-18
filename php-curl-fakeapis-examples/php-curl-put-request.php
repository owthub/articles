<?php
/*
Author: Sanjay Kumar
Email: onlinewebtutorhub@gmail.com 
Method: PUT
Description: PHP cURL request to update employee data to fakeapi server.
Website: https://api.onlinewebtutorblog.com/
*/

// API URL (Update information for employee ID = 1)
$url = 'https://api.onlinewebtutorblog.com/employees/1';

// POST Data
$data = array(
    "username" => "sanjay_owt",
    "name" => "Sanjay Kumar",
    "phone_number" => "1234567890",
    "complete_address" => "Sample location"
);

// Convert to JSON
$postdata = json_encode($data);

// Init cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT");
curl_setopt($ch, CURLOPT_POSTFIELDS, $postdata);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
    'Content-Type: application/json'
));
$result = curl_exec($ch);

curl_close($ch);

// Output Result
echo "<pre>";
print_r($result);
