<?php

session_start();

require_once 'db.php';


// Check if session variable is set
if (!isset($_SESSION['s_email'])) {
    echo json_encode(['status' => 'error', 'message' => 'User session not found']);
    exit;
}

// Prepare and execute the DELETE query
$stmt = $conn->prepare("DELETE FROM booked WHERE email = ?");
if (!$stmt) {
    echo json_encode(['status' => 'error', 'message' => 'Failed to prepare the query']);
    exit;
}
$stmt->bind_param('s', $_SESSION['s_email']);

if ($stmt->execute()) {
    echo json_encode(['status' => 'success', 'message' => 'You are a free bird now']);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No house found']);
}

// Close the statement and connection
$stmt->close();
$conn->close();
?>
