<?php 
 $email = $_REQUEST['email'];
 $jsonarray = [];
 $tenants = 0;
 $rooms =0;
 $conn = new mysqli("localhost", "root", "", "user_database");
 if($conn->connect_error)
 {
     die("Connection failed: " . $conn->connect_error);
 }
 $query = "SELECT * FROM booked WHERE owner = ? ";
 $stmt = $conn->prepare($query);
 $stmt->bind_param("s" , $email);
 if(!$stmt->execute())
 {
    die("execution failed" );
 }
 $result = $stmt->get_result();
 if($result->num_rows > 0)
 {
  while($row = $result->fetch_assoc())
  {
    $tenants++;
  }
 }
 $stmt->close();
 $query = "SELECT no_of_rooms FROM housedetails WHERE username = ? ";
 $stmt = $conn->prepare($query);
 $stmt->bind_param("s" , $email);
 if(!$stmt->execute())
 {
    die("execution failed 2" );
 }
 $result = $stmt->get_result();
 if($result->num_rows > 0)
 {
  while($row = $result->fetch_assoc())
  {
    $rooms += $row['no_of_rooms'];
  }
 }
 $stmt->close();
 $conn->close();
 $jsonarray = ["tenants" => $tenants , "rooms" => $rooms];
 echo json_encode($jsonarray);
?>