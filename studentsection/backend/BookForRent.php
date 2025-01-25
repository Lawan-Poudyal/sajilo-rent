<?php
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log'); // Specify the error log file

$servername = "localhost";
$username = "root";
$password = "";
$database = "user_database";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    error_log("Connection failed: " . $conn->connect_error); // Log connection error
    die(json_encode(['status' => 'error', 'message' => 'Database connection failed']));
}
// Get JSON input
$input = file_get_contents('php://input');
$data = json_decode($input, true);

$studentName = $data['student'];
$owner = $data['owner'];
$lat = $data['lat'];
$lng = $data['lng'];
$seen = 'no'; // Assuming a default value for the 'seen' column

$stmt = $conn->prepare("INSERT INTO rentrequest (sender, receiver, lat, lng, seen) VALUES (?, ?, ?, ?, ?)");
$stmt->bind_param("ssdds", $studentName, $owner, $lat, $lng, $seen); // Corrected bind_param types

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Send JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>