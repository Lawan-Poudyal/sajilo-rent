<?php 
$email = $_REQUEST['email'];
$jsonarray=[];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die(''. $conn->connect_error);
}
$query = 'SELECT sender , lat , lng FROM rentrequest WHERE receiver = ?';
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
        $jsonarray[] = ["email" => $row['sender'] , "lat"=> $row['lat'] , "lng"=>$row['lng']];
    }
}
$stmt->close();
$conn->close();
echo json_encode($jsonarray);
?>