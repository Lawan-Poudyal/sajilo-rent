<?php 
$oldpassword = $_REQUEST['oldPassword'];
$newpassword = $_REQUEST['newPassword'];
$email =$_REQUEST['email'];
$oldpassword = trim($oldpassword);
$newpassword = trim($newpassword);
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die("lol conn error");
}
$query = "SELECT * FROM signin WHERE email = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param("s" , $email);
if(!$stmt->execute())
{
    die("lol exec error");
}
$result = $stmt->get_result();
if($result->num_rows >0)
{
    while($row=$result->fetch_assoc()){
        if(password_verify($oldpassword , $row['password'])){
            $conn->close();
            $stmt->close();
            $conn = new mysqli('localhost' , 'root' , '' , 'user_database');
            $query = "UPDATE signin SET password =? WHERE email=?";
            $stmt = $conn->prepare($query);
            $pass = password_hash($newpassword , PASSWORD_DEFAULT);
            $stmt->bind_param('ss',$pass ,$email);
            $stmt->execute();
            if(!$stmt->affected_rows > 0)
            {
                die("lol no row affected");
            }
           echo "success";
        }
        else{
          
           echo "error";
        }
    }
}
?>