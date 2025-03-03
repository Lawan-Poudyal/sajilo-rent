<?php 
$lat = $_REQUEST['lat'];
$lng = $_REQUEST['lng'];
$username = $_REQUEST['username'];
$conn = new mysqli('localhost' , 'root' , '','user_database');
if ($conn->connect_error) {
    die(''. $conn->connect_error);
}
$sql = 'SELECT * FROM housedetails WHERE username = ? and latitude = ? and longitude = ?';
$stmt = $conn->prepare($sql);
$stmt->bind_param('sdd' ,$username, $lat, $lng);
if($stmt->execute())
{
$result = $stmt->get_result();
if($result->num_rows > 0){
    while($row = $result->fetch_assoc()){
        $jsonobj = array(
            'wifi_price' => $row['wifi_price'],
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
            'house_facing_direction'=>$row['house_facing_direction'],
            'gates_open'=>$row['gates_open'],
            'gates_close'=>$row['gates_close']
        );
    }
    echo json_encode($jsonobj);
}
else{
    echo "no such rows";
}
}
else{
echo "the query is wrong";
}
$stmt->close();
$conn->close();
?>