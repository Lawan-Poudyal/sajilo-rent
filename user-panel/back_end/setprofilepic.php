<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log');
$conn = new mysqli('localhost' ,'root' ,'' ,'user_database');
$jsonobj = [];
if($conn->connect_error)
{
    die("connnection couldn't be established");
}
$query = "SELECT image FROM  profilepicture WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s" ,$_SESSION['email']);
if(!$stmt->execute())
{
    die("query is wrong");
}
else{
    $result = $stmt->get_result();
    if($result->num_rows > 0)
    {
        $row = $result->fetch_assoc();
        $jsonobj = ["image" => $row['image']];
        echo json_encode($jsonobj);
    }
    else{
        $jsonobj = ["image" => "false"];
        echo json_encode($jsonobj);
    }
   
}
?>