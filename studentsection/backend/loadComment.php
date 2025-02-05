<?php
session_start();    
require_once 'db.php';

$stmt = $conn->prepare('SELECT review.reviewer , review.receiver , review.rating  ,review.comment, review.date , signin.firstName , signin.lastName
FROM review INNER JOIN signin ON review.reviewer = signin.email WHERE review.receiver = ?'); 
$stmt->bind_param("s",$_SESSION['s_email']);

if(!$stmt->execute()){
    die("Error executing");
}
$result = $stmt->get_result();
$reveiwData = [];
if($result->num_rows > 0){
    $reveiwData= $result->fetch_assoc();
    echo json_encode($reveiwData);
}   
else{
    echo json_encode(["status" => "error", "message"=>"Could not get reviews"]);
}

?>