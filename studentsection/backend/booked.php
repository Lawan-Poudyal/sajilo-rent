<?php

session_start();

require_once 'db.php';

$stmt = $conn->prepare("SELECT * FROM housedetails INNER JOIN booked ON housedetails.latitude = booked.lat and housedetails.longitude = booked.lng where booked.email = ?");
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
$stmt->close();
$conn->close();

?>