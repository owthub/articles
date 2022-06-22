<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi Select2 Ajax Autocomplete Search Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database configuration file 
require 'dbconfig.php';

// To read ajax
$countrySearchTerm = isset($_REQUEST['searchTerm']) && !empty($_REQUEST['searchTerm']) ? $_REQUEST['searchTerm'] : "";

if (!empty($countrySearchTerm)) {

    $countrySelect = $conn->prepare("SELECT * FROM countries WHERE name LIKE CONCAT('%', ?, '%')");
    $countrySelect->bind_param("s", $countrySearchTerm);
} else {

    $countrySelect = $conn->prepare("SELECT * FROM countries");
}

$countrySelect->execute();
$countries = $countrySelect->get_result();

$itemRecords = array();
while ($item = $countries->fetch_assoc()) {
    extract($item);
    $itemDetails = array(
        "id" => $id,
        "text" => $name
    );
    array_push($itemRecords, $itemDetails);
}

echo json_encode($itemRecords);

die;
