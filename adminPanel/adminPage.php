<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="http://localhost/sajilo-rent/adminPanel/adminPage.css">
</head>
<body>
    <?php
    $database = "user_database";
    $conn = new mysqli("localhost", "root", "", $database);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    $user_email_status = array(); // Initialize the associative array
    $user_email_code= array();
$sql2 = "SELECT * FROM `user_verification`"; // Correct SQL query
$result2 = $conn->query($sql2);

if ($result2 === false) {
    // Log or display error
    die("Error in query: " . $conn->error);
}

if ($result2->num_rows > 0) {
    while ($row = $result2->fetch_assoc()) {
        $email = $row['email'];
        $verify_num = $row['verification_number'];
        $user_status = $row['status'];
        // Add a new key-value pair to the associative array
        $user_email_status[$email]=$user_status;
        $user_email_code[$email]=$verify_num;

    }
}

    $conn->close();
    ?>

    <header>
        <figure>
            <img src="../resources/profile.png" width="50px" height="50px" alt="profile">
        </figure>
    </header>

    <section>
        <div class="data_box">
            <figure>
                <img src="../resources/logo.svg" alt="sajilo rent">
            </figure>
            <?php
            foreach ($user_email_status as $key => $value) {
                echo "<div class='data_block'>
                        <span>$key</span>:<span>$value</span> 
                        <button class='check-box'>✔</button>
                      </div>";
            }
            ?>
        </div>
    </section>
    <script>
        const body = document.body ;
        const section = body.querySelector('section');
        const dataBox = section.querySelector('.data_box')
        const dataBlock = body.getElementsByClassName('data_block');
        const buttonClass =section.querySelector('.check-box').className;
        function addGlobalEventListener(type , selector , callback , parent) {
        parent.addEventListener(type , function(e) {
           if(e.target.className==='check-box'){
           callback();
           }
        });
    }
        addGlobalEventListener("click","check-box", verifyUser , dataBox);

        function verifyUser() {
            console.log('hello');
        }

    </script>
</body>
</html>