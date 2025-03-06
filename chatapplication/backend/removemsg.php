<?php
$id = $_REQUEST['id'];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die(''. $conn->connect_error);
}
$query = "DELETE FROM chat WHERE id = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("i" , $id);
if(!$stmt->execute()){
    die("lol error");
}
echo 'msg successfully removed';
$query = "UPDATE chat set seenornot = 'unseen'";
$stmt = $conn->prepare($query);
if(!$stmt->execute()){
    die("lol error");
}
echo 'status succesfully updated';
$conn->close();
$stmt->close();

?>