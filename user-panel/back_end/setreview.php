<?php  
$reciever = $_REQUEST['receiver'];
$reviewer = $_REQUEST['reviewer'];
$rating = $_REQUEST['rating'];
$comment = $_REQUEST['comment'];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die(''. $conn->connect_error);
}
$query = "INSERT INTO review (reviewer , receiver , rating ,comment) VALUES (? , ? , ? ,?)";
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
?>