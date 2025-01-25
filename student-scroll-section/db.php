<?php
$db_server = "localhost";
$db_user = "root";
$db_pass = "lawan9863760395";
$db_name = "mydb";
$conn = "";

try {
    $conn = new mysqli(
        $db_server,
        $db_user,
        $db_pass,
        $db_name
    );
} catch (mysqli_sql_exception) {
    echo "Couldnt connect!<br>";
}
