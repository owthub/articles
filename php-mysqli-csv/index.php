<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP & MySQLi How To Save CSV Data To Database Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database file
require 'dbconfig.php';

$students = [];

if (($open = fopen("students.csv", "r")) !== FALSE) {

    while (($data = fgetcsv($open, 1000, ",")) !== FALSE) {
        $students[] = $data;
    }

    fclose($open);
}

// echo "<pre>";
// print_r($students);

if (!empty($students) && count($students) > 0) {

    foreach ($students as $index => $student) {

        if ($index == 0) {
            continue;
        }

        $stmt = $conn->prepare("INSERT INTO students (name, email, gender) VALUES(?, ?, ?)");
        $stmt->bind_param("sss", $student[0], $student[1], $student[2]);
        $stmt->execute();
    }
}
