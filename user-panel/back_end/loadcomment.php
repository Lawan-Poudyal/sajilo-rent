<?php 
error_reporting(E_ALL);
ini_set('display_errors', 1); // Enable error reporting
ini_set('log_errors', 1);     // Log errors instead of displaying them
ini_set('error_log', 'php_errors.log'); // Specify the error log file
session_start();
$email = $_SESSION['email'];
$jsonarr = [];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die("lol conn error");
}
$query ="SELECT review.reviewer , review.receiver , review.rating  ,review.comment, review.date , signin.firstName , signin.lastName
FROM review 
INNER JOIN signin ON review.receiver = signin.email
WHERE review.receiver = ?
";
$stmt = $conn->prepare($query);

$stmt->bind_param('s', $email);

if(!$stmt->execute())
{
    die("lol conn error while executing the query");

}
$result = $stmt->get_result();
if($result->num_rows > 0)
{
    while($row = $result->fetch_assoc())
    {
        array_push($jsonarr, (["username" => $row['firstName']." ".$row['lastName'] , "comment"=>$row['comment'] , "rating"=>$row['rating'], "date"=>$row['date']  ]));
    }
   echo json_encode($jsonarr);
}
else{

     array_push($jsonarr, (["error" => 'error']));
    echo json_encode($jsonarr);
}
?>