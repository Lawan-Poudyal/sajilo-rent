<?php 
$sender = $_REQUEST['sender'];
$reciever = $_REQUEST['receiver'];
$message = $_REQUEST['message'];
$jsonarray = [];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die(''. $conn->connect_error);
}
$query = "INSERT INTO chat (sender , receiver , message , seenornot) VALUE (? , ? , ? , 'unseen')";
$stmt = $conn->prepare($query);
$stmt->bind_param("sss" , $sender , $reciever ,$message);
if(!$stmt->execute()){
    die("lol error");
}

$stmt->close();
$conn->close();
echo 'success';
?>