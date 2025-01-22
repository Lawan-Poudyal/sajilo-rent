<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log'); // Specify the error log file

session_start();
$servername = "localhost";
$username = "root";
$password = "";
$database = "user_database";

$lat = 0;
$lng = 0;
if(isset($_POST)){
    $data = file_get_contents("php://input");
    $result =json_decode($data,true);
    $lat = $result["lat"];
    $lng = $result["lng"];
}
// Create connection
$conn = new mysqli($servername, $username, $password, $database);
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error); // Log connection error
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
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

?>
