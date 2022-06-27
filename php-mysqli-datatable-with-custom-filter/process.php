<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi How To Add Custom Filter To DataTable Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database configuration file 
require 'dbconfig.php';

$column = array('name', 'username', 'email', 'gender', 'designation');

$query = "SELECT * FROM employees";

if (isset($_POST['filter_designation']) && $_POST['filter_designation'] != '') {
    $query .= ' WHERE designation = "' . $_POST['filter_designation'] . '"';
}

if (isset($_POST['order'])) {
    $query .= ' ORDER BY ' . $column[$_POST['order']['0']['column']] . ' ' . $_POST['order']['0']['dir'] . ' ';
} else {
    $query .= ' ORDER BY id DESC ';
}

$query1 = '';

if ($_POST["length"]) {
    $query1 = 'LIMIT ' . $_POST['start'] . ', ' . $_POST['length'];
}

$statement = $conn->prepare($query . $query1);
$statement->execute();
$result = $statement->get_result();

$data = array();
while ($item = $result->fetch_assoc()) {
    $sub_array = array();
    $sub_array[] = $item['name'];
    $sub_array[] = $item['username'];
    $sub_array[] = $item['email'];
    $sub_array[] = $item['gender'];
    $sub_array[] = $item['designation'];
    $data[] = $sub_array;
}

function count_all_data($conn, $filter = "")
{
    if (!empty($filter)) {
        $query = "SELECT count(*) FROM employees WHERE designation = '" . $filter . "'";
    } else {
        $query = "SELECT count(*) FROM employees";
    }

    $statement = $conn->prepare($query);
    $statement->execute();
    $number_filter_row = $statement->get_result()->fetch_row();
    return $number_filter_row = $number_filter_row[0];
}

$output = array(
    "draw"       =>  intval($_POST["draw"]),
    "recordsTotal"   =>  count_all_data($conn),
    "recordsFiltered"  =>  count_all_data($conn, $_POST['filter_designation']),
    "data"       =>  $data
);

echo json_encode($output);
