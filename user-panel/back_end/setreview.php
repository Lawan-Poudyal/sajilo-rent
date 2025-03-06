<?php  
session_start();
header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Methods: POST");
header("Content-Type: application/json");
if ($_SERVER["REQUEST_METHOD"] === "POST"){
  $jsondata = file_get_contents("php://input");
  $data = json_decode($jsondata , true); 
  $reciever = $data['reciever'];
  $reviewer = $_SESSION['email'];
  $rating = $data['rating'];
  $comment = $data['comment'];
  $conn = new mysqli('localhost' , 'root' , '' , 'user_database');
  if($conn->connect_error)
  {
      die(''. $conn->connect_error);
  }
  $query = "INSERT INTO review (reviewer , reciever , rating ,comment) VALUES (? , ? , ? ,?)";
  $stmt = $conn->prepare($query);
  $stmt->bind_param('ssis' , $reviewer , $reciever , $rating , $comment );
  if(!$stmt->execute())
  {
      die('error while executing');
  }
  else {
    $stmt->close();
    $query = "DELETE FROM booked WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s" , $reciever);
    $stmt->execute();
    if($stmt->affected_rows>0)
    {
      echo "removed from database";
    }
    else{
      echo "ther is a problem";
    }
    $stmt->close();
    $conn->close();
  }
}
?>