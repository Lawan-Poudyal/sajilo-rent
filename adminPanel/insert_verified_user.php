<?php
session_start();
       if($_SERVER['REQUEST_METHOD']==='POST') {
        $verifyEmail=$_POST['email'];
         if($_SESSION['email']==$verifyEmail) {
            $verifyEmail = $_POST['email'];
        $conn = mysqli_connect("localhost", "root", "", "user_database");
        
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        
        // Prepare and execute the SELECT statement
        $stmt = $conn->prepare("SELECT * FROM user_verification WHERE email = ?");
        if ($stmt === false) {
            die("Prepare failed: " . $conn->error);
        }
        
        $stmt->bind_param("s", $verifyEmail);
        if (!$stmt->execute()) {
            die("Execute failed: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        $verification_number = null; // Initialize variables
        $status = null;
        
        if ($result->num_rows > 0) { // Corrected from num_row to num_rows
            $rows = $result->fetch_assoc();
            $verification_number = $rows['verification_number'];
            $status = $rows['status'];
        } else {
            echo "No record found with that email.";
            $stmt->close();
            $conn->close();
            exit; // Exit if no record found
        }
        
        // Prepare and execute the DELETE statement
        $stmt2 = $conn->prepare("DELETE FROM user_verification WHERE email = ?");
        if ($stmt2 === false) {
            die("Prepare failed: " . $conn->error);
        }
        
        $stmt2->bind_param("s", $verifyEmail);
        $stmt2->execute();
        
        if ($stmt2->affected_rows > 0) {
            echo "Record deleted successfully.";
        } else {
            echo "No record found with that email.";
        }
        
        // Prepare and execute the INSERT statement
        $stmt3 = $conn->prepare("INSERT INTO verified_users(email, verification_number, status) VALUES (?, ?, ?)");
        if ($stmt3 === false) {
            die("Prepare failed: " . $conn->error);
        }
        
        // Correctly bind parameters with types
        $stmt3->bind_param("ssi", $verifyEmail, $verification_number, $status); // Assuming verification_number and status are integers
        $stmt3->execute();
        // Close statements and connection
        $stmt->close();
        $stmt2->close();
        $stmt3->close();
        $conn->close();
            setcookie('msgs','you are verified by the admin ! \n you will be redirected to login page in 10s ' ,time()+5000 ,"/");
        }
       }
?>