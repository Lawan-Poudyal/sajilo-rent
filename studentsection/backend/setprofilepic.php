<?php 
session_start();
require_once 'db.php';

$jsonobj = [];
$query = "SELECT image FROM  profilepicture WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s" ,$_SESSION['s_email']);
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