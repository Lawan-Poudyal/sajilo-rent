<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log'); // Specify the error log file

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