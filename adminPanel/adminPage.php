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

    $user_verify = [];
    $sql2 = "SELECT email, verification_number, status FROM `user_verification`";
    $result2 = $conn->query($sql2);

    if ($result2->num_rows > 0) {
        while ($row = $result2->fetch_assoc()) {
            $key = $row['email'];
            $value = $row['verification_number'] . " " . $row['status'];
            $user_verify[$key] = $value;
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
            foreach ($user_verify as $key => $value) {
                // Split the value into verification_number and status
                list($verification_number, $status) = explode(" ", $value);
                echo "<div class='data_block'>
                        <span>$key</span>:<span>$value</span> 
                        <button onClick='removeBlock(this, \"$key\", \"$verification_number\", \"$status\")'>✔</button>
                      </div>";
            }
            ?>
        </div>
    </section>

    <script>
        function removeBlock(button, email, verification_number, status) {
            const block = button.parentElement;

            // Send data to the server
            fetch('insert_verified_user.php', {
    method: 'POST',
    headers: {
        'Content-Type': 'application/json'
    },
    body: JSON.stringify({
        email: email,
        verification_number: verification_number,
        status: status
    })
})
.then(response => response.text()) // Change to text() to see the raw response
.then(data => {
    console.log(data); // Log the raw response
    try {
        const jsonData = JSON.parse(data); // Try to parse it as JSON
        if (jsonData.success) {
            block.remove();
        } else {
            console.error('Error:', jsonData.message);
        }
    } catch (e) {
        console.error('Error parsing JSON:', e);
    }
})
.catch((error) => {
    console.error('Error:', error);
});
        }
    </script>
</body>
</html>