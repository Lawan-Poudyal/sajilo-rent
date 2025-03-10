

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/x-icon" href="/sajilo-rent/resources/logo.svg">
    <title>Sajilo Rent</title>
    <link rel="stylesheet" href="front.css">
</head>
<body>
    <!--      php         -->
    <?php
 ini_set('display_errors', 1);
 ini_set('display_startup_errors', 1);
 error_reporting(E_ALL);
 session_start();
 $error = ""; // Initialize error message
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = htmlspecialchars(trim($_POST['email']));
            $password = trim($_POST['password']);

            // Database connection
      // Database connection
      $conn = mysqli_connect("localhost", "root", "", "user_database");
      if (!$conn) {
          die("Connection failed: " . mysqli_connect_error());
      }

      // First query - check signin table
      $stmt = $conn->prepare("SELECT * FROM signin WHERE email = ?");
      if ($stmt === false) {
          die("Prepare failed: " . $conn->error);
      }

      $stmt->bind_param("s", $email);

      if (!$stmt->execute()) {
          die("Execute failed: " . $stmt->error);
      }

      $result = $stmt->get_result();

      if ($result->num_rows > 0) {
          $row = $result->fetch_assoc();
          $hashedPassword = $row['password'];

          // Verify the password
          if (password_verify($password, $hashedPassword)) {
              $username = $row['firstName'] . " " . $row['lastName'];
              // Set session variables
            

              // Second query - check verified_users table
              $stmt2 = $conn->prepare("SELECT * FROM verified_users WHERE email = ?");
              if ($stmt2 === false) {
                  die("Prepare failed: " . $conn->error);
              }

              $stmt2->bind_param("s", $email);

              if (!$stmt2->execute()) {
                  die("Execute failed: " . $stmt2->error);
              }

              $result2 = $stmt2->get_result();

              if ($result2->num_rows > 0) {
                  $row2 = $result2->fetch_assoc();
                  $status = $row2['status'];
                  
                  if ($status == 'student') {
                      $_SESSION['s_username'] = $username;
                      $_SESSION['s_email'] = $email;
                      header("Location: /sajilo-rent/studentsection/displayLatLng.php");
                  } else {
                      $_SESSION['username'] = $username;
                      $_SESSION['email'] = $email;
                      header("Location: /sajilo-rent/user-panel/owner-page.php");
                  }
              } else {
                  header("Location: /sajilo-rent/user-panel/user-home.php");
              }
              exit();
          } else {
              $error = "* Password is incorrect.";
          }
      } else {
          $error = "* Email not found.";
      }

      // Close all statements and connection
      $stmt->close();
      if (isset($stmt2)) {
          $stmt2->close();
      }
      $conn->close();
  } else {
      $error = "* Fill in both email and password.";
  }
}
?>
    <main>
        <figure>
            <img src="../resources/logo.svg" alt="sajilo rent">
            <figcaption>SAJILO RENT</figcaption>
        </figure>
        <section class="outer-box"></section>
        <section class="inner-box">
            <figure>
                <img src="../resources/logo.svg" alt="sajilo rent">
            </figure>
            <section>
                <h1>Log In</h1>
                <form id="signUpForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <button class="sign-up-button" id="SignUpButton" type="submit">Log In</button>
                    <span class="error"> <?php echo $error; ?> </span>
                    <div>
                        Don't have an account?
                        <a href="../loginsignup_page/signup.php"><strong>Sign Up</strong></a>
                    </div>
                </form>
            </section>
        </section>
    </main>
</body>
</html>