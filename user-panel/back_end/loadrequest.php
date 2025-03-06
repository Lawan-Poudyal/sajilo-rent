<?php 
session_start();
$email = $_SESSION['email'];
$jsonarray=[];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die(''. $conn->connect_error);
}
$query = 'SELECT rentrequest.sender , rentrequest.lat , rentrequest.lng , profilepicture.image,signin.firstName,signin.lastName FROM rentrequest 
LEFT JOIN profilepicture ON rentrequest.sender = profilepicture.email
INNER JOIN signin ON rentrequest.sender = signin.email
WHERE rentrequest.receiver = ?';
$stmt = $conn->prepare($query);
$stmt->bind_param("s" , $email);
if(!$stmt->execute()){
    die("lol error");
}
$result = $stmt->get_result();
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {   
        $jsonarray[] = ["email" => $row['sender'] , "lat"=> $row['lat'] , "lng"=>$row['lng'] , "img"=>$row["image"],"username" => $row['firstName']." ".$row["lastName"]];
    }
}
else{
    $jsonarray[] = ["error" => "error"];
}
$stmt->close();
$conn->close();
echo json_encode($jsonarray);
?>