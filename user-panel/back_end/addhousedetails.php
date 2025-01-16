<?php 
session_start();
$image1_path = "";
$image2_path = "";
$image3_path = "";
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Collect form data
    $price = $_POST['price'];
    $no_of_rooms = $_POST['no-of-rooms'];
    $no_of_roommates = $_POST['no-of-roommates'];
    $gates_open = $_POST['gates-open'];
    $gates_close = $_POST['gates-close'];
    $parking = $_POST['parking'];
    $house_facing_direction = $_POST['house-facing-direction'];
    $wifi_price = $_POST['wifi'];
    $username = $_SESSION['username']; 
    $latitude = $_POST['lat'];
    $longitude = $_POST['lng'];
    $floor_level = $_POST['floor-level'];
    $electricity = $_POST['electricity'];
    

    $image1_name = $_FILES['image']['name'];
    $image2_name = $_FILES['image-2']['name'];
    $image3_name = $_FILES['image-3']['name'];
    $target_dir = "images/";
    $image1_path = $target_dir . basename($image1_name);
    $image2_path = $target_dir . basename($image2_name);
    $image3_path = $target_dir . basename($image3_name);
    $conn = new mysqli("localhost", "root", "", "user_database");
    if (move_uploaded_file($_FILES['image']['tmp_name'], $image1_path) &&
    move_uploaded_file($_FILES['image-2']['tmp_name'], $image2_path) &&
    move_uploaded_file($_FILES['image-3']['tmp_name'], $image3_path)) {

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Prepare the query using placeholders for parameters
    $query = "INSERT INTO housedetails 
              (username, no_of_rooms, no_of_roommates, gates_open, gates_close, wifi_price, 
               image1, image2, image3, latitude, longitude, price, parking, electricity, floor_level, house_facing_direction)
              VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?)";
    
    // Prepare statement
    $stmt = $conn->prepare($query);
    
    if ($stmt === false) {
        echo "Error preparing the statement: " . $conn->error;
        exit;
    }

    // Bind parameters to the statement
    $stmt->bind_param("siississsddissis", 
        $username, 
        $no_of_rooms, 
        $no_of_roommates, 
        $gates_open, 
        $gates_close, 
        $wifi_price, 
        $image1_path, 
        $image2_path, 
        $image3_path, 
        $latitude, 
        $longitude, 
        $price, 
        $parking, 
        $electricity, 
        $floor_level, 
        $house_facing_direction
    );

    if ($stmt->execute()) {
        header("Location:/sajilo-rent/user-panel/owner-page.php");
    } else {
        echo "Error executing query: " . $stmt->error;
    }
    $stmt->close();
    $conn->close();
    }else{
        echo "error moving files";
    }

}
?>

