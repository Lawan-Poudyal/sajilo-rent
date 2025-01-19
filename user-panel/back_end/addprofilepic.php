<?php 
session_start();
$image1_path = "";
$to_update = false;
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $image1_name = $_FILES['image']['name'];
    $target_dir = "images/";
    $image1_path = $target_dir . basename($image1_name);
    $target_dir = "images/";
    $image2_path =  $target_dir . basename($image1_name);
    if (move_uploaded_file($_FILES['image']['tmp_name'], $image2_path)) {
        $conn = new mysqli("localhost", "root", "", "user_database");
        if($conn->connect_error)
        {
            die("Connection failed: " . $conn->connect_error);
        }
        $query = "SELECT * FROM profilepicture WHERE email = ?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("s" , $_SESSION['email']);
        if(!$stmt->execute())
        {
            die("SOME ERROR WHILE TRYING TO FIND THE EMAIL QUERY");
        }
        $result = $stmt->get_result();
        if($result->num_rows >0)
        {
            $to_update = true;
        }
        $stmt->close();
        $conn->close();
      
        $conn = new mysqli("localhost", "root", "", "user_database");
       if(!$to_update)
       {
        $query = "INSERT INTO profilepicture (email , image ) VALUE (? , ?)";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss" , $_SESSION['email'] , $image1_path);
       }else{
        $query = "UPDATE profilepicture SET image = ? WHERE email=?";
        $stmt = $conn->prepare($query);
        $stmt->bind_param("ss" , $image1_path, $_SESSION['email'] );
       }
        if ($stmt->execute()) {
            header("Location:/sajilo-rent/user-panel/owner-profile.php");
        } else {
            echo "Error executing query: " . $stmt->error;
        }
    
        // Close the statement and connection
        $stmt->close();
        $conn->close();

   
    }
    else{
        echo "couldn't move files lol";
    }
  
}
?>