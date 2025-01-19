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
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if($_SERVER['REQUEST_METHOD']==='POST') {
        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
          }
        $firstName = test_input($_POST['fname']);
        $lastName = test_input($_POST['lname']);
        $email = test_input($_POST['email']);
        $password=test_input($_POST['password']);
    
        $database ="user_database";
        $conn = mysqli_connect("localhost","root" ,"", $database );
    if(!$conn){
       
        die("connection failed");
    }
    $hashedPassword = password_hash($password , PASSWORD_DEFAULT);
    $sql="INSERT INTO signin(email , firstName , lastName , password) VALUES ('$email', '$firstName' , '$lastName' , '$hashedPassword' )";
    if(mysqli_query($conn , $sql)) {
        header("Location:/sajilo-rent/loginsignup_page/login.php");
    exit();
    }
    mysqli_close($conn);
    }
    ?>
    
<main>
  <figure>
    <img src="../resources/logo.svg" alt="sajilo rent" >
    <figcaption>
      SAJILO RENT
    </figcaption>
  </figure>

  <section class="outer-box">
  </section>
  <section class="inner-box">
    <figure>
      <img src="../resources/logo.svg" alt="sajilo rent" >
    </figure>
    <section>
      <h1>Sign Up</h1>
      <form id="signUpForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post" onsubmit="return checkPassword(event);">
        <input type="text" id="fname" name="fname" placeholder="First Name">
        <input type="text" id="lname" name="lname" placeholder="LastName">
        <input type="email" id="email" name="email" placeholder="Email">
        <input type="password" name="password" id="password" placeholder="password">
        <input type="password" name="confirmPassword" id="confirmPassword" placeholder="Confirm Password">
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