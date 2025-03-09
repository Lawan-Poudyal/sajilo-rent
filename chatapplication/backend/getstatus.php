<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log'); // Specify the error log file

$email = $_REQUEST['email'];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die(''. $conn->connect_error);
}
$query = "SELECT status FROM verified_users WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s" , $email);
if(!$stmt->execute())
{
    die("dead");
}
$result = $stmt->get_result();
if($result->num_rows>0)
{
while($row = $result->fetch_assoc())
{
    echo $row['status'];
}
}
$stmt->close();
$conn->close();
?>