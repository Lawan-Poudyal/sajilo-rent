<?php
        error_reporting(E_ALL);
        ini_set('display_errors', 1);

        session_start();

        // Check if the user is logged in
        
        if (isset($_SESSION['s_username']) && isset($_SESSION['s_email'])) {
        // User is logged in, you can use the session variables
        $username = $_SESSION['s_username'];
        $email = $_SESSION['s_email'];
        }
        $servername = "localhost";
        $username = "root";
        $password = "";
        $database = "user_database";

        // Create connection
        $conn = new mysqli($servername, $username, $password, $database);

        // Check connection
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT * FROM housedetails";
        $result = $conn->query($sql);

        $latitudesandLongitudes = [];
        if ($result) {
            while ($row = $result->fetch_assoc()) {
                $latitudesandLongitudes[] = $row;
            }
        } else {
            die("Query failed: " . $conn->error);
        }
        $jsonData = json_encode($latitudesandLongitudes, JSON_PRETTY_PRINT);
        echo $jsonData;
?>