<?php
session_start();
if($_SERVER['REQUEST_METHOD']==='POST') {
    $email = $_POST['email'];
    $password=$_POST['password'];
}
$conn = mysqli_connect("localhost","root" , "" ,"user_database");
if(!$conn){
    die("connection failed");
}
$sql="SELECT *FROM `signin` WHERE `email`='$email'";
$result = mysqli_query($conn , $sql); // result is collection of tuples 
$num = mysqli_num_rows($result);
if($num>0) {
    $row = mysqli_fetch_assoc($result); 
    $hashedPassword=$row['password'];
    if( password_verify($password , $hashedPassword)){
        $username = $row['firstName']. " " . $row["lastName"];
        $_SESSION['username'] = $username; 
        $_SESSION['email'] = $email;
        header("Location: /sajilo-rent/user-panel/owner-page.php");
        exit();  
    }
}
header("Location:/sajilo-rent/sign%20in/sign-up.html");
   exit();
?>