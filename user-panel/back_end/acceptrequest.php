<?php 
session_start();
$email = $_REQUEST['username'];
$lat = number_format($_REQUEST['lat'],17);
$lng = number_format($_REQUEST['lng'] , 17);
$reciever = $_SESSION['email'];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    echo "lol conn error";
}
$query = "DELETE FROM rentrequest WHERE sender = ? and receiver = ? ";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss" , $email , $reciever);
if(!$stmt->execute())
{
    echo "didn't execute";
}
if(!($stmt->affected_rows > 0))
{
    echo "no such data exists";
}
$conn->close();
$stmt->close();
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    echo "lol conn error";
}
$query = "INSERT INTO booked (email , owner, lat , lng ) VALUES(? , ? , ? ,?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssdd" , $email , $reciever , $lat , $lng);
if(!$stmt->execute())
{
    echo "didn't execute" ;
}
else{
    echo "success";
}
$conn->close();
$stmt->close();
?>