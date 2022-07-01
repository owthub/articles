<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi Form Validation Using jQuery Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include Database
include './dbconfig.php';

$name = htmlspecialchars(trim($_POST['username']));
$email = htmlspecialchars(trim($_POST['email']));
$pass = htmlspecialchars(trim($_POST['password']));
$mobile = htmlspecialchars(trim($_POST['mobile']));

if (empty($name) || empty($email) || empty($pass) || empty($mobile)) {

    echo '<div class="alert alert-success">Please fill all required field</div>';

    exit();
} else {

	// Save data

    $sql = "INSERT INTO users(username,email,password,mobile) VALUES (?, ?, ?, ?)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $name, $email, $pass, $mobile);

    $stmt->execute();

    echo '<div class="alert alert-success">Data Successfully Inserted</div>';

    exit();
}
