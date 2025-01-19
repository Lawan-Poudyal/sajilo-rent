<?php 
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];
$username = $_REQUEST['username'];
echo "the vlaue of lat is " .$lat . "the value of lng is " .$lng . "and hi" . $username;
$conn = new mysqli('localhost' , 'root' , '','user_database');
if ($conn->connect_error) {
    die(''. $conn->connect_error);
}
$sql = 'DELETE FROM housedetails WHERE username = ? and latitude = ? and longitude = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('sdd' ,$username, $lat, $lng);
if($stmt->execute())
{
if($stmt->affected_rows >0)
{
    echo "data deletion successsful"; 
    
}
else{
echo "no such data to remove";
}
}
else{
echo "the query not executed";
}
$stmt->close();
$conn->close();
?>