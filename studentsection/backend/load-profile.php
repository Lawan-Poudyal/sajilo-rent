<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

session_start();

require_once 'db.php';

header("Content-Type: application/json"); // Always return JSON

if (!isset($_SESSION["s_email"])) {
    echo json_encode(['status' => 'error', 'message' => 'User not logged in']);
    exit;
}

$stmt = $conn->prepare("SELECT booked.owner , profilepicture.image , housedetails.price , housedetails.image1
              FROM signin 
              LEFT JOIN profilepicture ON signin.email = profilepicture.email
              LEFT JOIN booked ON signin.email = booked.email
              LEFT JOIN housedetails ON booked.owner = signin.email  
              WHERE signin.email = ?;
        ");

$stmt->bind_param("s", $_SESSION["s_email"]);

if (!$stmt->execute()) {
    error_log("Query Execution Failed: " . $stmt->error);
    echo json_encode(['status' => 'error', 'message' => 'Database error']);
    exit;
}

$result = $stmt->get_result();
$detailsOfOwner = [] ;

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
       array_push($detailsOfOwner , (["owner" => $row['owner'] , "image" => ($row['image']) ? $row['image'] : 'images/default-profile.png' , "price" => $row['price'] , "image1" => $row['image'] ]));
    }
    echo json_encode($detailsOfOwner, JSON_PRETTY_PRINT);
} else {
    echo json_encode(['status' => 'error', 'message' => 'No house found']);
}

$stmt->close();
$conn->close();
?>
