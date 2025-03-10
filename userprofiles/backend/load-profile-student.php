<?php

require_once 'db.php';

session_start();

header("Content-Type: application/json"); // Added header function

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get JSON input
    $json = file_get_contents('php://input');
    $data = json_decode($json, true);
    
    // Check if email exists and is not empty
    if (!isset($data['email']) || empty($data['email'])) {
        echo json_encode(['status' => 'error', 'message' => 'Email is required']);
        exit;
    }
    
    $email = $data['email'];
    
    $stmt = $conn->prepare(
        
        // "SELECT housedetails.username, housedetails.price, housedetails.image1, 
        // housedetails.image2, housedetails.image3, profilepicture.image,signin.firstName,signin.lastName
        // FROM housedetails
        // INNER JOIN booked ON booked.owner = housedetails.username
        // LEFT JOIN profilepicture ON profilepicture.email = booked.email
        // INNER JOIN signin ON signin.email = booked.email
        // WHERE booked.email = ?;"
        
        "SELECT 
    booked.owner, 
    profilepicture.image AS profile_image, 
    housedetails.price, 
    housedetails.image1 AS house_image, 
    signin.lastName, 
    signin.firstName
FROM signin
LEFT JOIN profilepicture ON signin.email = profilepicture.email
LEFT JOIN booked ON signin.email = booked.email
LEFT JOIN housedetails ON booked.owner = housedetails.username
WHERE signin.email = ?;
         " 
    );

    $stmt->bind_param("s", $email);

    if (!$stmt->execute()) {
        error_log("Query Execution Failed: " . $stmt->error);
        echo json_encode(['status' => 'error', 'message' => 'Database error']);
        exit;
    }

    $result = $stmt->get_result();
    $detailsOfOwner = []; // Initialize as empty array
    
    if ($result->num_rows > 0) {
        $detailsOfOwner = $result->fetch_assoc(); // Get the first row directly
        echo json_encode($detailsOfOwner, JSON_PRETTY_PRINT);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'No house found']);
    }

    $stmt->close();
    $conn->close();
} else {
    echo json_encode(['status' => 'error', 'message' => 'Invalid request method']);
}
?>