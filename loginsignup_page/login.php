<?php
session_start();
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
    $error = "";
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        if (!empty($_POST['email']) && !empty($_POST['password'])) {
            $email = $_POST['email'];
            $password = $_POST['password'];
            if (empty($email) || empty($password)) {
            }
            $conn = mysqli_connect("localhost", "root", "", "user_database.sql");
            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            // Secure query using prepared statement
            $stmt = $conn->prepare("SELECT * FROM signin WHERE email = ?");
            $stmt->bind_param("s", $email);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $hashedPassword = $row['password'];
                if (password_verify($password, $hashedPassword)) {
                    $username = $row['firstName'] . " " . $row["lastName"];
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;
                    header("Location: /sajilo-rent/user-panel/owner-page.php");
                    exit();
                } else {
                    $error = " * password is incorrect";
                }
            } else {
                $error = " * email not found";
            }
            $stmt->close();
            $conn->close();
        } else {
            $error = "* fill both email and password";
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
                <h1>Log In</h1>
                <form id="signUpForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                    <input type="email" id="email" name="email" placeholder="Email">
                    <input type="password" name="password" id="password" placeholder="password">
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