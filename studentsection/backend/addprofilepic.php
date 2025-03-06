<?php 
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'php_errors.log');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Check if file was uploaded
    if (!isset($_FILES['image']) || $_FILES['image']['error'] !== UPLOAD_ERR_OK) {
        http_response_code(400);
        echo json_encode([
            'status' => 'error',
            'message' => 'No file uploaded or upload error occurred'
        ]);
        exit;
    }

    $target_dir = "images/";
    
    // Create directory if it doesn't exist
    if (!file_exists($target_dir)) {
        mkdir($target_dir, 0777, true);
    }

    // Use the original filename from user's computer
    $filename = basename($_FILES['image']['name']);
    $image_path = $target_dir . $filename;
    
    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
        try {
            $conn = new mysqli("localhost", "root", "", "user_database");
            
            if ($conn->connect_error) {
                throw new Exception("Connection failed: " . $conn->connect_error);
            }

            // Check if user already has a profile picture
            $query = "SELECT * FROM profilepicture WHERE email = ?";
            $stmt = $conn->prepare($query);
            $stmt->bind_param("s", $_SESSION['s_email']);
            $stmt->execute();
            $result = $stmt->get_result();
            $exists = $result->num_rows > 0;
            $stmt->close();

            // Insert or update profile picture
            if (!$exists) {
                $query = "INSERT INTO profilepicture (email, image) VALUES (?, ?)";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $_SESSION['s_email'], $image_path);
            } else {
                $query = "UPDATE profilepicture SET image = ? WHERE email = ?";
                $stmt = $conn->prepare($query);
                $stmt->bind_param("ss", $image_path, $_SESSION['s_email']);
            }

            if ($stmt->execute()) {
                echo json_encode([
                    'status' => 'success',
                    'message' => 'Profile picture updated successfully'
                ]);
            } else {
                throw new Exception("Error executing query: " . $stmt->error);
            }

            $stmt->close();
            $conn->close();

        } catch (Exception $e) {
            http_response_code(500);
            echo json_encode([
                'status' => 'error',
                'message' => $e->getMessage()
            ]);
        }
    } else {
        http_response_code(500);
        echo json_encode([
            'status' => 'error',
            'message' => 'Failed to move uploaded file'
        ]);
    }
} else {
    http_response_code(405);
    echo json_encode([
        'status' => 'error',
        'message' => 'Method not allowed'
    ]);
}
?>