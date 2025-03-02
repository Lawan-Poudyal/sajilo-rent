<?php

session_start();

require_once 'db.php';

header("Content-Type: application/json"); // Always return JSON

// Fetch the owner from 'booked' table
$stmt = $conn->prepare("SELECT owner FROM booked WHERE email = ?");
$stmt->bind_param("s", $_SESSION["s_email"]);

if (!$stmt->execute()) {
    error_log("Query Execution Failed: " . $stmt->error);
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
    exit;
}

$result = $stmt->get_result();
$ownerEmail = $result->fetch_assoc(); // Fetch single result
$stmt->close();
if(!$ownerEmail) {
    echo json_encode(['status' => 'error', 'message' => 'No house found']);
    exit;
}

$stmt = $conn->prepare("SELECT image FROM profilepicture WHERE email = ?");
$stmt->bind_param("s", $ownerEmail["owner"]); // Correct key used here
$stmt->execute();
$result3 = $stmt->get_result();
$ownerProfilePic = $result3->fetch_assoc();
$stmt->close();


// Fetch all the houses of owner
$stmt = $conn->prepare("SELECT * FROM housedetails WHERE username = ?");
$stmt->bind_param("s", $ownerEmail["owner"]); // Correct key used here
$stmt->execute();
$result2 = $stmt->get_result();
$ownerHouseDetails = $result2->fetch_all(MYSQLI_ASSOC); // Fetch all results as an associative array
$stmt->close();

// Fetch owner's details from 'signin' table
$stmt = $conn->prepare("SELECT firstName, lastName FROM signin WHERE email = ?");
$stmt->bind_param("s", $ownerEmail["owner"]);
$stmt->execute();
$result3 = $stmt->get_result();
$ownerName = $result3->fetch_assoc(); // Fetch single result
$stmt->close();

if ($ownerName) {
    $detailsOfOwner = [
        'ownerName' => $ownerName,
        'ownerHouseDetails' => $ownerHouseDetails,
        'ownerProfile' => $ownerProfilePic
    ];
    echo json_encode($detailsOfOwner, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['status' => 'error', 'message' => 'Owner details not found']);
}

$conn->close();

?>