<?php
error_reporting(E_ALL);
ini_set('display_errors',1);
ini_set('log_errors',1);
ini_set('error_log','php_errors.log');
session_start();
$database = 'user_database';
$server = 'localhost';
$user = 'root';
$password = '';

$conn = new mysqli($server,$user,$password,$database);
if($conn->connect_error){
    die("Error");
}
$stmt = $conn->prepare("SELECT * FROM housedetails INNER JOIN booked ON housedetails.latitude = booked.lat and housedetails.longitude = booked.lng where email = ?");
$stmt->bind_param('s',$_SESSION['s_email']);

if(!$stmt->execute()){
    die("Error in executing statement");
}
$result = $stmt->get_result();
$detailsOfOwner = [];
if($result->num_rows > 0){
    $row = $result->fetch_assoc(); 
    $detailsOfOwner = $row; 
    echo json_encode($detailsOfOwner,JSON_PRETTY_PRINT);
}
else {
    echo json_encode(['status' => 'error', 'message' => 'No house found']);
}


?>