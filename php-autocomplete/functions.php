<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP & MySQLi Autocomplete Search From Database Using jQuery UI
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database configuration file 
require 'dbconfig.php';

if ($_POST) {
    // Get data via ajax
    $search = isset($_POST['search']) && !empty($_POST['search']) ? $_POST['search'] : "";

    $itemRecords = array();

    if (!empty($search)) {

        $countrySelect = $conn->prepare("SELECT * FROM countries WHERE name LIKE CONCAT('%', ?, '%')");
        $countrySelect->bind_param("s", $search);
    } else {

        $countrySelect = $conn->prepare("SELECT * FROM countries");
    }

    $countrySelect->execute();
    $countries = $countrySelect->get_result();

    while ($item = $countries->fetch_assoc()) {
        extract($item);
        $itemDetails = array(
            "value" => $id,
            "label" => $name
        );
        array_push($itemRecords, $itemDetails);
    }

    echo json_encode(array(
        "status" => true,
        "data" => $itemRecords
    ));
}
