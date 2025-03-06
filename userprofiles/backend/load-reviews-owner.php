<?php

session_start();

require_once 'db.php';

header("Content-Type: application/json"); // Always return JSON
if($_SERVER["REQUEST_METHOD"] == "POST"){

    $json_data = file_get_contents('php://input');
    $data = json_decode($json_data, true);
    $owner_email = $data['username'];
    $stmt = $conn->prepare("SELECT reviewer, rating, comment, date FROM review WHERE receiver = ?");
    $stmt->bind_param("s", $owner_email);

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
}

?>