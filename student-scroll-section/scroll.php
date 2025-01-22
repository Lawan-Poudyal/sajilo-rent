<?php

include("db.php");



$stmt = $conn->prepare("SELECT LAT, LNG, Images, PRICE, CONTACT FROM LatLng");
if (!$stmt) {
    die('Query preparation failed: ' . $conn->error);
}
// Execute the statement
$stmt->execute();
if (!$stmt->execute()) {
    die('Execution failed: ' . $stmt->error);
}

// Bind result variables
$stmt->bind_result($lat, $lng, $images, $price, $contact);


// function html($stmt)
// {
while ($stmt->fetch()) {
    echo '<div class="image-item">';
    echo '<img src="' . htmlspecialchars($images) . '" alt="Room Image">';
    echo '<p>Latitude: ' . htmlspecialchars($lat) . '</p>';
    echo '<p>Longitude: ' . htmlspecialchars($lng) . '</p>';
    echo '<p>Price: $' . htmlspecialchars($price) . '</p>';
    echo '<p>Contact: ' . htmlspecialchars($contact) . '</p>';
    echo '</div>';
}
// }


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>K xa</title>
</head>

<body>
    <?php ?>
</body>

</html>

<?php

$stmt->close();
$conn->close();
