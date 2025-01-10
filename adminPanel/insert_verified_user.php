<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

$database = "user_database";
$conn = new mysqli("localhost", "root", "", $database);

if ($conn->connect_error) {
    die(json_encode(['success' => false, 'message' => 'Connection failed: ' . $conn->connect_error]));
}

// Get the JSON data from the request
$data = json_decode(file_get_contents('php://input'), true);

$email = $data['email'];
$verification_number = $data['verification_number'];
$status = $data['status'];

// Prepare and bind
$stmt = $conn->prepare("INSERT INTO verified_users (email, verification_number, status) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $verification_number, $status);

$response = [];
if ($stmt->execute()) {
    $response['success'] = true;
} else {
    $response['success'] = false;
    $response['message'] = "Error: " . $stmt->error;
}

$stmt->close();
$conn->close();

// Return JSON response
header('Content-Type: application/json');
echo json_encode($response);
?>