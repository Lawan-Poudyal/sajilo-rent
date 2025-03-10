<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/sajilo-rent/adminPanel/adminPage.css">
</head>
<body class ="container">
    <?php
    $database = "user_database";
    $conn = new mysqli("localhost", "root", "", $database);
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $user_email_status = array(); // Initialize the associative array
    $user_email_code= array();
    $sql2 = "SELECT * FROM `user_verification`"; // Correct SQL query
    $result2 = $conn->query($sql2);

if ($result2 === false) {
    // Log or display error
    die("Error in query: " . $conn->error);
}

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $email = $row['email'];
        $verify_num = $row['verification_number'];
        $user_status = $row['status'];
        // Add a new key-value pair to the associative array
        $user_email_status[$email]=$user_status;
        $user_email_code[$email]=$verify_num;

    }
}

    $conn->close();
    ?>
    <?php
// if ($_SERVER["REQUEST_METHOD"] === "POST") {
//     // Retrieve the email value from $_POST
//     if (isset($_POST['email'])) {
//         $email = $_POST['email'];
//         $database = "user_database";

//         // Create a database connection
//         $conn = new mysqli("localhost", "root", "", $database);

//         // Check connection
//         if ($conn->connect_error) {
//             die("Connection failed: " . $conn->connect_error);
//         }

//         // Prepare the SQL statement
//         $verification_number = $user_email_code[$email];
//         $status = $user_email_status[$email];
//         $stmt3 = $conn->prepare("INSERT INTO notification(email, message) VALUES (?, ?)");
//         if ($stmt3 === false) {
//             die("Prepare failed: " . $conn->error);
//         }
        
//         // Bind parameters
//         $message = "Hello sir! You are verified by the admin. You will be directed to " . $status . " page in 5 seconds.";
//         $stmt3->bind_param("ss", $email, $message);
        
//         // Execute the statement
//         if ($stmt3->execute()) {
//             echo "Data is inserted successfully";
//         } else {
//             die("Failed execution: " . $stmt3->error); // Changed $stmt2 to $stmt3
//         }
        
//         // Close the statement
//         $stmt3->close();
//         // Correct the SQL query by using placeholders correctly
//         $stmt2 = $conn->prepare("INSERT INTO verified_users (email, verification_number, status) VALUES (?, ?, ?)");
//         if ($stmt2 === false) {
//             die("prepare failed: " . $conn->error);
//         }
//         // Bind the parameters correctly
//         $stmt2->bind_param("sss", $email, $verification_number, $status);
        
//         if ($stmt2->execute()) {
//             echo "Data is inserted successfully";
//         } else {
//             die("Failed execution: " . $stmt2->error);
//         }
        
//         $stmt2->close();
//         $stmt = $conn->prepare("DELETE FROM user_verification WHERE email=?");
//         if ($stmt === false) {
//             die("Prepare failed: " . $conn->error);
//         }

//         // Bind the email parameter
//         $stmt->bind_param("s", $email);

//         // Execute the statement
//         if ($stmt->execute()) {
//             echo "User with email '$email' has been successfully deleted.";
//         } else {
//             die("Execute failed: " . $stmt->error);
//         }

//         // Close the statement and connection
//         $stmt->close();
//         $conn->close();
//     } else {
//         echo "Email not provided.";
//     }
// }
 ?>

    <header>
        <figure>
            <img src="../resources/profile.png" width="50px" height="50px" alt="profile">
        </figure>
    </header>

    <section class="container">
        <div class="data_box">
            <figure>
                <img src="../resources/logo.svg" alt="sajilo rent">
            </figure>
            <?php
            foreach ($user_email_status as $key => $value) {
                echo "<div class='data_block'>
                        <span>$key</span>:<span>$value</span> 
                        <button class='check-box'>✔</button>
                      </div>";
            }
            ?>
        </div>
    </section>
    <script src="..\\adminPanel\\adminPage.js"></script>
</body>
</html>