<?php
/*
Author: Sanjay Kumar
Email: onlinewebtutorhub@gmail.com 
Method: DELETE
Description: PHP cURL request to delete employee data from fakeapi server.
Website: https://api.onlinewebtutorblog.com/
*/

// API URL (Delete employee ID = 1)
$url = 'https://api.onlinewebtutorblog.com/employees/1';

// Init cURL
$ch = curl_init($url);
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($ch);

curl_close($ch);

// Output Result
echo "<pre>";
print_r($result);


