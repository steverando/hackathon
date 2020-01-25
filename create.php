<?php
require_once("connect.php");
require_once("functions.php");

// validate
$username = $_REQUEST["username"];
$phone    = $_REQUEST["phone"];
$password = $_REQUEST["password"];

if(empty($username) || empty($phone) || empty($password)){
    die("Please fill all fields");
}

if(strlen($phone) < 10 || strlen($phone) > 10){
    die("Phone number should be 10 digits long");
}

if(!ctype_digit($phone)){
    die("Phone number should contain only numbers");
}

if(strlen($password) < 4){
    die("Password should be a minimum 4 characters long");
}

// system generated parameters
$code         = rand(1111,99999);
$date         = date('d-M-Y H:i:s');
$encpass      = md5($password);
$formatPhone  = "+254".substr($phone,-9);

// check from database for duplicate record
$duplicate = mysqli_query($db,"SELECT * FROM `users` WHERE `username` = '$username'");
if(mysqli_num_rows($duplicate ) > 0){
    die("Username is taken, please try another one.");
}

// insert into database
$insert = mysqli_query($db,"INSERT INTO `users`(`username`,`phone`,`password`,`code`,`date`,`status`)
VALUES('$username','$formatPhone','$encpass','$code','$date','pending')");

if($insert){ 
    $message = "Hello ".$username.". Your passcode is ".$code;
    $sms = new SendSMS();
    $sms->sendMessage($formatPhone,$message);
    die("Record inserted!");
}else{
    echo mysqli_error($db);
}