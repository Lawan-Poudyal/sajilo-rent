<?php

require_once 'db.php';

session_start();

("Content-Type: application/json"); // Always return JSON

if (!isset($_SESSION["s_email"])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$stmt = $conn->prepare("SELECT housedetails.username, housedetails.price, housedetails.image1, 
       housedetails.image2, housedetails.image3, profilepicture.image
        FROM housedetails
        INNER JOIN booked ON booked.owner = housedetails.username
        INNER JOIN profilepicture ON profilepicture.email = booked.email
        WHERE booked.email = ?;
        ");

$stmt->bind_param("s", $_SESSION["s_email"]);

if (!$stmt->execute()) {
    error_log("Query Execution Failed: " . $stmt->error);
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
    exit;
}

$result = $stmt->get_result();
$detailsOfOwner ;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $detailsOfOwner = $row; 
    }
    echo json_encode($detailsOfOwner, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No house found']);
}

$stmt->close();
$conn->close();
?>
