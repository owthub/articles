<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi How To Use Select2 for Multiple Select Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Database configuration
$host   = "localhost";
$dbuser = "admin";
$dbpass = "Admin@123";
$dbname = "php_applications";

// Create database connection
$conn = new mysqli($host, $dbuser, $dbpass, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
