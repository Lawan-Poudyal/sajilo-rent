<?php 
session_start();
$email = $_REQUEST['username']; // basically email is for the student
$reciever = $_SESSION['email']; // this is for the owner
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
else{
    echo "sucessfully removed";
}
$conn->close();
$stmt->close();
