<?php

session_start();

require_once 'db.php';

header("Content-Type: application/json"); // Always return JSON

$stmt = $conn->prepare("SELECT reviewer, rating, comment, date FROM review WHERE receiver = ?");
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