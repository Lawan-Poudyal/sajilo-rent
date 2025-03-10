<?php 
session_start();
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $oldpassword = trim($_POST['oldPassword']);

    $newpassword = trim($_POST['newPassword']);
    
    $email = isset($_SESSION["s_email"]) ? $_SESSION["s_email"] : $_SESSION["email"];

    $conn = new mysqli('localhost', 'root', '', 'user_database');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $query = "SELECT password FROM signin WHERE email = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $email);

    if (!$stmt->execute()) {
        die("Execution failed: " . $stmt->error);
    }

    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($oldpassword, $row['password'])) {
            $stmt->close();

            $query = "UPDATE signin SET password = ? WHERE email = ?";
            $stmt = $conn->prepare($query);
            $newHashedPassword = password_hash($newpassword, PASSWORD_DEFAULT);
            $stmt->bind_param('ss', $newHashedPassword, $email);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo json_encode(["status" => "success", "message" => "Password changed Successfully"]);
            } else {
                echo  json_encode(["status" => "error", "message" => "Failed to change password"]);
            }
        } else {
            echo json_encode(["status" => "error", "message" => "Incorrect Currrent Password"]);
        }
    }
     else {
        echo "Email not found.";
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>