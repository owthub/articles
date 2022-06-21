<?php 
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi jQuery Ajax File Upload with Type Validation
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

include "dbconfig.php";

if (isset($_FILES['file'])) {
    
    $file_name = $_FILES['file']['name'];    
    // $file_size = $_FILES['file']['size'];    
    $file_tmp = $_FILES['file']['tmp_name'];     
    // $file_type = $_FILES['file']['type'];        
        
    $stmt = $conn->prepare("INSERT INTO files (file_name) VALUES (?)");
    $stmt->bind_param("s", $file_name);
        
    if (move_uploaded_file($file_tmp ,"uploads/".$file_name)) {

        if ($stmt->execute()) {

            echo "<h5 class='alert alert-primary'>File inserted Successfully!</h5>";
        }else{

            echo "<h5 class='alert alert-primary'>Failed to insert File</h5>";
        }
    }else{
        echo "<h5 class='alert alert-primary'>Failed to insert File</h5>";
    }
}