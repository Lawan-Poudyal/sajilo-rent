<?php

session_start();

require_once 'db.php';

$stmt = $conn->prepare("SELECT owner FROM booked WHERE email = ?");
$stmt->bind_param("s", $_SESSION['s_email']);

if(!$stmt->execute()) {
    die("Cannot execute;");
}
$result = $stmt->get_result();
$ownerInfo = [];
if ($result->num_rows > 0) {
    $ownerInfo = $result->fetch_assoc();
}
$stmt->close();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $reviewer = manipulateData($_POST['ownerReview']);
    
    // Ensure $latLngData keys are set
    if (!empty($ownerInfo['owner'])) {
        $stmt = $conn->prepare("INSERT INTO review (reviewer, receiver, rating, comment) VALUES (?, ?,?, ?)");
        $rating = 5;
        // Use correct data types (assuming lat/lng are doubles)
        $stmt->bind_param("ssis", $_SESSION['s_email'],$ownerInfo['owner'] ,$rating ,$reviewer);
        
        if ($stmt->execute()) {
            $response['status'] = 'success';
            echo json_encode($response);
        }
        else{
            $response['status'] = 'failure';
            echo json_encode($response);
        }
        $stmt->close();
    } else {
        die("No latitude/longitude data found for the given email");
    }
}

function manipulateData($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
?>