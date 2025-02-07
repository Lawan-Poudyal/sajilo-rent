<?php 
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