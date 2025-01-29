<?php

require_once 'db.php';

$lat = 0;
$lng = 0;
if(isset($_POST)){
    $data = file_get_contents("php://input");
    $result =json_decode($data,true);
    $lat = $result["lat"];
    $lng = $result["lng"];
}

$tolerance = 0.000001;

$sql = "
    SELECT * 
    FROM housedetails 
    WHERE ABS(latitude - ?) < ? AND ABS(longitude - ?) < ?
";
$stmt = $conn->prepare($sql);

if ($stmt === false) {
    die("Prepare failed: " . $conn->error);
}

$stmt->bind_param("dddd", $lat, $tolerance, $lng, $tolerance);

if (!$stmt->execute()) {
    die("Execute failed: " . $stmt->error);
}
$result = $stmt->get_result();

$houseDetails = [];
if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $houseDetails[] = $row;
    $_SESSION['houseDetails'] = $houseDetails;
    echo json_encode(['status' => 'success']);
}
else {
    echo json_encode(['status' => 'error', 'message' => 'No house found']);
}   
$stmt->close();
$conn->close();
?>
