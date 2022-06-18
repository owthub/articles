<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP & MySQLi How To Save JSON Data To Database Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database file
require 'dbconfig.php';

$data = [];

$json = file_get_contents("countries.json");
$countries_data = json_decode($json);

foreach ($countries_data->countries as $key => $value) {
    $data[] = [
        "sortname" => $value->sortname,
        "name" => $value->name,
        "phonecode" => $value->phoneCode
    ];
}

// echo "<pre>";
// print_r($data);

if (!empty($data) && count($data) > 0) {

    foreach ($data as $country) {

        $stmt = $conn->prepare("INSERT INTO countries (name, sortname, phonecode) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $country['name'], $country['sortname'], $country['phonecode']);
        $stmt->execute();
    }
}
