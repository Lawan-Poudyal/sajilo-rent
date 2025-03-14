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
  <!--  php      -->
  <?php
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }
    $firstName = test_input($_POST['fname']);
    $lastName = test_input($_POST['lname']);
    $email = test_input($_POST['email']);
    $password = test_input($_POST['password']);
    $ph_number = test_input($_POST['number']);


    $database = "user_database";
    $conn = mysqli_connect("localhost", "root", "", $database);
    if (!$conn) {

      die("connection failed");
    }
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    $sql = "INSERT INTO signin(email , firstName , lastName , number, password) VALUES ('$email', '$firstName' , '$lastName','$ph_number' , '$hashedPassword' )";
    mysqli_query($conn, $sql);
  
    mysqli_close($conn);
    header("Location:/sajilo-rent/loginsignup_page/login.php");
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
        <form id="signUpForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>"  autocomplete="off" method="post" onsubmit="return checkPassword(event);">
          <input type="text" id="fname" name="fname" placeholder="First Name" required >
          <input type="text" id="lname" name="lname" placeholder="LastName" required>
          <input type="email" id="email" name="email" placeholder="Email" required>
          <input type="tel" id="number" name="number" placeholder="Phone number" minlength="10" maxlength="10" required>
          <input type="password" name="password" id="password" placeholder="Password" required>
          <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password" required>
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