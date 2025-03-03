<?php 
session_start();
$username = $_SESSION['email'];
$jsonobj = [];
$conn = new mysqli('localhost' , 'root' , '','user_database');
if ($conn->connect_error) {
    die(''. $conn->connect_error);
}
$sql = 'SELECT * FROM housedetails WHERE username = ? ';
$stmt = $conn->prepare($sql);
$stmt->bind_param('s' ,$username);
if($stmt->execute())
{
$result = $stmt->get_result();
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
      
        array_push($jsonobj, ([ 'wifi_price' => $row['wifi_price'],
        'image1' => $row['image1'],
        'image2' => $row['image2'],
        'image3'=> $row['image3'],
        'price' => $row['price'],
        'electricity' => $row['electricity'],
        'no_of_rooms' => $row['no_of_rooms'],
        'no_of_roommates' => $row['no_of_roommates'],
        'latitude' => $row['latitude'],
        'longitude' => $row['longitude'],
        'parking' => $row['parking'],
         'floor_level' => $row['floor_level'],
        'house_facing_direction'=>$row['house_facing_direction'] ]));

    }
    echo json_encode($jsonobj);
}
else{
    array_push($jsonobj , (['error' => 'error']));
    echo json_encode($jsonobj);
}
}
else{
echo "the query is wrong";
}
$stmt->close();
$conn->close();
?>