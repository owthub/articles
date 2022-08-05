<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP How To Work with Data Pagination Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/
$hostname = "localhost";
$username = "admin";
$password = "Admin@123";

try {

    $connection = new PDO("mysql:host=$hostname;dbname=php_applications", $username, $password);
    // set the PDO error mode to exception
    $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {

    echo "Database connection failed: " . $e->getMessage();
}
