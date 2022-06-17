<?php
/*
 @Author: Sanjay Kumar
 @Project: Generate QRcode in PHP Using Library
 @Email: onlinewebtutorhub@gmail.com
 @Website: https://onlinewebtutorblog.com/
*/

// Include the qrlib file
include 'phpqrcode/qrlib.php';

// $text variable has data for QR
$text = "Online Web Tutor - Learn for Skills";

// QR Code generation using png()
// When this function has only the
// text parameter it directly
// outputs QR in the browser

QRcode::png($text);
