<?php
if($_SERVER['REQUEST_METHOD']==='POST') {
    $firstName = $_POST['fname'];
    $lastName = $_POST['lname'];
    $email = $_POST['email'];
    $password=$_POST['password'];

    $database ="user_database";
    $conn = mysqli_connect("localhost","root" ,"", $database );
if(!$conn){
   
    die("connection failed");
}
echo"connection successful";
//------------------------------------------ creating database
// $sql= "CREATE DATABASE user_database";  // $sql is a string 
// mysqli_query($conn , $sql);  // first parameter is boolean and second parameter is string giving instruction to create database

//-------------------------------------------------------------------------------creating table
//$sql = "CREATE TABLE signin(emailVARCHAR(30) NOT NULL , fistName VARCHAR(20) NOT NULL, lastName VARCHAR(20) NOT NULL , password VARCHAR(20) NOT NULL,PRIMARY KEY(email))";
//mysqli_query($conn , $sql );

//--------------------------------------------------------------------- inserting into database
$hashedPassword = password_hash($password , PASSWORD_DEFAULT);
$sql="INSERT INTO signin(email , firstName , lastName , password) VALUES ('$email', '$firstName' , '$lastName' , '$hashedPassword' )";
if(mysqli_query($conn , $sql)) {
    header("Location:http://localhost:8080/sajilo-rent/sign%20in/sign-up.html");
exit();
}
mysqli_close($conn);
}
?>