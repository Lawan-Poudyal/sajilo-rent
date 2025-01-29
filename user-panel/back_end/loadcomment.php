<?php 
$email = $_REQUEST['email'];
$jsonarr = [];
$conn = new mysqli('localhost' , 'root' , '' , 'user_database');
if($conn->connect_error)
{
    die("lol conn error");
}
$query ="SELECT review.reviewer , review.reciever , review.rating  ,review.comment , signin.firstName , signin.lastName
FROM review 
INNER JOIN signin ON review.reviewer = signin.email
WHERE review.reciever = ?
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
        array_push($jsonarr, (["username" => $row['firstName']." ".$row['lastName'] , "comment"=>$row['comment'] , "rating"=>$row['rating']  ]));
    }
   echo json_encode($jsonarr);
}
else{

    echo 'empty';
}
?>