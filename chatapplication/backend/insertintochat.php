<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log'); // Specify the error log file

$sender = $_REQUEST['sender'];
$reciever = $_REQUEST['reciever'];
$message = $_REQUEST['message'];
$jsonarray = [];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die(''. $conn->connect_error);
}
$query = "INSERT INTO chat (sender , reciever , message , seenornot) VALUE (? , ? , ? , 'unseen')";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss" , $sender , $reciever ,$message);
if(!$stmt->execute()){
    die("lol error");
}

$stmt->close();
$conn->close();
echo 'success';
?>