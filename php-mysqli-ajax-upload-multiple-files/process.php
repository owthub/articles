<?php
/*
 @Author: Sanjay Kumar
 @Project: PHP MySQLi How to Upload Multiple Files with Ajax
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the database configuration file 
include "dbconfig.php";

if (!empty($_FILES['multipleFile']['name'])) {

    $multiplefile = $_FILES['multipleFile']['name'];

    foreach ($multiplefile as $name => $value) {

        $allowFile = array('txt', 'pdf', 'docx', 'csv', 'xlsx');

        $fileExnt = explode('.', $multiplefile[$name]);

        if (in_array($fileExnt[1], $allowFile)) {

            if ($_FILES['multipleFile']['size'][$name] > 0 && $_FILES['multipleFile']['error'][$name] == 0) {

                $fileTmp = $_FILES['multipleFile']['tmp_name'][$name];

                $newFile =  rand() . '.' . $fileExnt[1];
                $target_dir = 'uploads/' . $newFile;

                if (move_uploaded_file($fileTmp, $target_dir)) {

                    $stmt = $conn->prepare("INSERT INTO files (file_name) VALUES (?)");
                    $stmt->bind_param("s", $target_dir);

                    $stmt->execute();
                }
            }
        }
    }
}
