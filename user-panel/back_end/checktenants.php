<?php 
session_start();
$email = $_SESSION['email'];
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    echo "lol conn error";
}
$query = "SELECT * FROM booked WHERE owner = ? and lat = ? and lng = ? ";
$stmt = $conn->prepare($query);
$stmt->bind_param("sdd" , $email , $lat , $lng);
if(!$stmt->execute())
{
    echo "didn't execute";
}
$result = $stmt->get_result();
echo $result->num_rows;
$conn->close();
$stmt->close();
?>