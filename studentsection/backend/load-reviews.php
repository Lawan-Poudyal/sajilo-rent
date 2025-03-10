<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();
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
header("Content-Type: application/json"); // Always return JSON

$stmt = $conn->prepare("SELECT reviewer, rating, comment, date FROM review WHERE reciever = ?");
$stmt->bind_param("s", $_SESSION["s_email"]);

if (!$stmt->execute()) {
    error_log("Query Execution Failed: " . $stmt->error);
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
    exit;
}

$result = $stmt->get_result();
$reviewDetails = [] ;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $reviewDetails[] = $row; 
    }
    echo json_encode($reviewDetails, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No house found']);
}

$stmt->close();
$conn->close();


?>