<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi Dynamic Dependent Dropdown using jQuery Ajax
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database configuration file 
require 'dbconfig.php';

$countrySelect = $conn->prepare("SELECT * FROM countries");
$countrySelect->execute();
$countries = $countrySelect->get_result();

// To read ajax
$type = isset($_REQUEST['type']) && !empty($_REQUEST['type']) ? $_REQUEST['type'] : "";

if (!empty($type)) {

    if ($type == "get_states") {

        $country_id = isset($_REQUEST['country_id']) && !empty($_REQUEST['country_id']) ? $_REQUEST['country_id'] : "";
        $stateSelect = $conn->prepare("SELECT * FROM states WHERE country_id = ?");
        $stateSelect->bind_param("i", $country_id);
        $stateSelect->execute();
        $states = $stateSelect->get_result();

        $itemRecords = array();
        while ($item = $states->fetch_assoc()) {
            extract($item);
            $itemDetails = array(
                "id" => $id,
                "name" => $name
            );
            array_push($itemRecords, $itemDetails);
        }

        echo json_encode(array(
            "status" => true,
            "data" => $itemRecords
        ));

        die;
    } else if ($type == "get_cities") {

        $state_id = isset($_REQUEST['state_id']) && !empty($_REQUEST['state_id']) ? $_REQUEST['state_id'] : "";
        $citySelect = $conn->prepare("SELECT * FROM cities WHERE state_id = ?");
        $citySelect->bind_param("i", $state_id);
        $citySelect->execute();
        $cities = $citySelect->get_result();

        $itemRecords = array();
        while ($item = $cities->fetch_assoc()) {
            extract($item);
            $itemDetails = array(
                "id" => $id,
                "name" => $name
            );
            array_push($itemRecords, $itemDetails);
        }

        echo json_encode(array(
            "status" => true,
            "data" => $itemRecords
        ));

        die;
    }
} else {
}
