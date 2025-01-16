<?php 
$email = $_REQUEST['email'];
$lat = (number_format($_REQUEST['lat'],17)*10)/10;
$lng = (number_format($_REQUEST['lng'] , 17)*10)/10;
$reciever = $_REQUEST['username'];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die("lol conn error");
}
$query = "DELETE FROM rentrequest WHERE sender = ? and receiver = ? ";
$stmt = $conn->prepare($query);
$stmt->bind_param("ss" , $email , $reciever);
if(!$stmt->execute())
{
    die("didn't execute");
}
if(!($stmt->affected_rows > 0))
{
    die("no such data exists");
}
$conn->close();
$stmt->close();
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die("lol conn error");
}
$query = "INSERT INTO booked (email , owner, lat , lng ) VALUES(? , ? , ? ,?)";
$stmt = $conn->prepare($query);
$stmt->bind_param("ssdd" , $email , $reciever , $lat , $lng);
if(!$stmt->execute())
{
    die("didn't execute");
}
$conn->close();
$stmt->close();
?>