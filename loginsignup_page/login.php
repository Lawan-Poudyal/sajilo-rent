<?php
session_start();
session_abort();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
            $conn = mysqli_connect("localhost", "root", "", "user_database");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Use prepared statement for security
            $stmt = $conn->prepare("SELECT signin.firstName , signin.lastName, signin.email ,signin.password , user_verification.status FROM signin JOIN user_verification WHERE signin.email = ? ");
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
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    $verificationvalue = $row['status'];
                    if($verificationvalue === "student")
                    {
                        header("Location: /sajilo-rent/studentsection/displayLatLng.php");
                    }
                    else if($verificationvalue === "owner")
                    {
                    header("Location: /sajilo-rent/user-panel/owner-page.php");// change gareu
                    }
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