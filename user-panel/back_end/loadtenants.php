<?php 
$email = $_REQUEST['email'];
$jsonarray=[];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die(''. $conn->connect_error);
}
$query = "SELECT booked.email ,booked.owner,profilepicture.image, signin.firstName , signin.lastName
FROM booked 
LEFT JOIN  profilepicture ON booked.email = profilepicture.email
INNER JOIN signin  ON booked.email = signin.email 
WHERE booked.owner = ? OR booked.email = ?"; // remove the OR part later on
$stmt = $conn->prepare($query);
$stmt->bind_param("ss" , $email , $email);
if(!$stmt->execute()){
    die("lol error");
}
$result = $stmt->get_result();
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {   
        if($row['owner'] === $email)
        {
        array_push($jsonarray , ["email" => $row['email'] , "username"=> $row['firstName'].' '.$row['lastName'] , "image"=>$row['image']]);
        }
        else{
            array_push($jsonarray , ["email" => $row['owner'] , "username"=> $row['firstName'].' '.$row['lastName'] , "image"=>$row['image']]);
        }
    }
}
$stmt->close();
$conn->close();
echo json_encode($jsonarray);
?>