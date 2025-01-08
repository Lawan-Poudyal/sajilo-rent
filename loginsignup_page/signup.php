<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="front.css">
</head>

<body>
    <!--  php      -->
<?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    session_start(); // Start session to use $_SESSION

    $error = ""; // Initialize error message
    
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = htmlspecialchars(trim($_POST['email']));
            $password = trim($_POST['password']);
    
            // Database connection
            $conn = mysqli_connect("localhost", "root", "", "user_database.sql");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
    
            // Use prepared statement for security
            $stmt = $conn->prepare("SELECT * FROM signin WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();
    
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row['password'];
    
                // Verify the password
                if (password_verify($password, $hashedPassword)) {
                    $username = $row['firstName'] . " " . $row['lastName'];
    
                    // Set session variables
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
    
                    // Redirect to owner page
                    echo"success";
                    header("Location: /sajilo-rent/user-panel/owner-page.php");
                    exit();
                } else {
                    $error = "* Password is incorrect.";
                }
            } else {
                $error = "* Email not found.";
            }
    
            $stmt->close();
            $conn->close();
        } else {
            $error = "* Fill in both email and password.";
        }
    }
    ?>
    <main>
        <figure>
            <img src="../resources/logo.svg" alt="sajilo rent">
            <figcaption>
                SAJILO RENT
            </figcaption>
        </figure>

        <section class="outer-box">
        </section>
        <section class="inner-box">
            <figure>
                <img src="../resources/logo.svg" alt="sajilo rent">
            </figure>
            <section>
                <h1>Sign Up</h1>
                <form id="signUpForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" onsubmit="return checkPassword(event);">
                    <input type="text" id="fname" name="fname" placeholder="First Name" required>
                    <input type="text" id="lname" name="lname" placeholder="LastName" required>
                    <input type="email" id="email" name="email" placeholder="Email" required>
                    <input type="password" name="password" id="password" placeholder="Password" required>
                    <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
                    <div class="error-message"></div>
                    <button class="sign-up-button" id="SignUpButton" type="submit">Sign Up</button>

                    <div>
                        Already have an account?
                        <a href="../loginsignup_page/login.php"><strong>Log In</strong></a>
                    </div>
                </form>
            </section>
        </section>
    </main>
    <script src="../user-panel/script/conformPassword.js"></script>
</body>

</html>