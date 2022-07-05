<?php

/*
 @Author: Sanjay Kumar
 @Project: How To Read XML Data To Array in PHP Tutorial
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

$xmlString = file_get_contents('books.xml');
$xmlObject = simplexml_load_string($xmlString);

$json = json_encode($xmlObject);
$phpArray = json_decode($json, true);

echo "<pre>";
print_r($phpArray);
