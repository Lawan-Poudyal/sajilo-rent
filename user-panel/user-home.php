<?php
    session_start();
    include("../header.php");
    ?>
    <?php
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $password = $_POST['password'];
        $checkpassword = '';
        $verificationnumber = $_POST['verificationnumber'];
        $email = $_POST['email'];
        $ownerorstudent = $_POST['ownerorstudent'];
        $conn = new mysqli('localhost', 'root', '', 'user_database');
        $exists = false;
        $errorreason = 'change';
        $username = '';
        if ($conn->connect_error) {
            echo '' . $conn->connect_error;
        } else {
            $query = 'SELECT firstName , lastName , password  FROM signin WHERE email = ?';
            $stms = $conn->prepare($query);
            $stms->bind_param("s", $email);
            $stms->execute();
            $result = $stms->get_result();
            if ($result->num_rows > 0) {
                $row = $result->fetch_assoc();
                $exists = true;
                $verificationfailure = 'false';
                $username = $row['firstName'] . " " . $row['lastName']; // here the first and last name is beiung combined
                $errorreason = 'account verified';
                $checkpassword = $row['password'];
            } else {
                $exists = false;
                $verificationfailure = 'true';
                $errorreason = 'email not found';
            }
            if (!password_verify($password, $checkpassword) && $exists) {
                $exists = false;
                $verificationfailure = 'true';
                $errorreason = ' password error';
            }
        }
        $conn->close();
        $stms->close();
        $result->close();
        $conn = new mysqli('localhost', 'root', '', 'user_database');
        if ($exists) {
            if ($conn->connect_error) {
                echo '' . $conn->connect_error;
            } else {
                $query = 'SELECT email FROM user_verification WHERE email = ?';
                $stms = $conn->prepare($query);
                $stms->bind_param('s', $email);
                $stms->execute();
                $result = $stms->get_result();
                if ($result->num_rows > 0) {
                    $exists = false;
                    $verificationfailure = 'true';
                    $errorreason = 'email already verified';
                } else {
                    $exists = true;
                    $verificationfailure = 'false';
                    $errorreason = 'email verified';
                }
            }
            $conn->close();
            $stms->close();
            $result->close();
        }
        if ($exists) {
            //////////////////////////////////////////////////////////////
            $conn = new mysqli('localhost', 'root', '', 'user_database');
            if ($conn->connect_error) {
                echo '' . $conn->connect_error;
            } else {
                $query = 'INSERT INTO user_verification (email , verification_number , status) VALUES (?,?,?)';
                $stms = $conn->prepare($query);
                $stms->bind_param('sss', $email, $verificationnumber, $ownerorstudent);
                if ($stms->execute()) {

                    $stms->close();
                    $conn->close();
                    if($ownerorstudent == "owner"){                    
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;}
                    else{
                        $_SESSION['s_username'] = $username;

                        $_SESSION['s_email'] = $email;}
    
                }
                else {
                    echo "Error inserting data: " . $stmt->error;
                    $stms->close();
                    $conn->close();
                }
            }
        }
    }
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Sajilo Rent</title>
        <link rel="icon" type="image/x-icon" href="../resources/logo.svg">
        <link rel="stylesheet" href="/sajilo-rent/user-panel/styles/user-home-style.css">

        <link rel="stylesheet" href="/sajilo-rent/universal-styling/style.css">

        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css" />
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css" />
        <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    </head>

    <body>
        <?php
        $verifyEmail = '';
        if ($_SERVER['REQUEST_METHOD'] === 'GET') {
            if (isset($_GET['q'])) {
                $verifyEmail = $_GET['q'];
                    $conn = mysqli_connect("localhost", "root", "", "user_database");
                    unset($_GET['q']);
                    if (!$conn) {
                        die("Connection failed: " . mysqli_connect_error());
                    }

                    // Prepare and execute the SELECT statement
                    $stmt = $conn->prepare("SELECT * FROM user_verification WHERE email = ?");
                    if ($stmt === false) {
                        die("Prepare failed: " . $conn->error);
                    }

                    $stmt->bind_param("s", $verifyEmail);
                    if (!$stmt->execute()) {
                        die("Execute failed: " . $stmt->error);
                    }

                    $result = $stmt->get_result();
                    $verification_number = null; // Initialize variables
                    $status = null;

                    if ($result->num_rows > 0) { // Corrected from num_row to num_rows
                        $rows = $result->fetch_assoc();
                        $verification_number = $rows['verification_number'];
                        $status = $rows['status'];
                    }


                    // Prepare and execute the INSERT statement
                    $stmt3 = $conn->prepare("INSERT INTO verified_users(email, verification_number, status) VALUES (?, ?, ?)");
                    if ($stmt3 === false) {
                        die("Prepare failed: " . $conn->error);
                    }

                    // Correctly bind parameters with types
                    $stmt3->bind_param("sis", $verifyEmail, $verification_number, $status); // Assuming verification_number and status are integers
                    $stmt3->execute();

                    setcookie('msgs', 'you are verified by the admin ! , you will be redirected to login page in 10s ', time() + 5000, "/");

                    // Prepare and execute the DELETE statement
                    $stmt2 = $conn->prepare("DELETE FROM user_verification WHERE email = ?");
                    if ($stmt2 === false) {
                        die("Prepare failed: " . $conn->error);
                    }
                    $stmt2->bind_param("s", $verifyEmail);
                    $stmt2->execute();
                    // Close statements and connection
                    $stmt->close();
                    $stmt2->close();
                    $stmt3->close();
                    $conn->close();
                
            }
        }
        ?>
        <div class="notification">
        </div>
        <!-- <header class="header">
            <nav class="header-nav">
                <div class="header-nav-element">
                    <button id="logo-btn" onclick="showaside2()">
                        <figure>
                            <img src="/sajilo-rent/resources/logo.png" alt="Sajilo-Rent-logo" title="Sajilo-Rent-logo" height="50" width="50">
                        </figure>
                    </button>
                </div>
                <div class="header-nav-element">
                    <form action="" class="header-nav-element-form search1">
                        <input type="text" placeholder="Search" class="search-bar">
                        <button class="navbtn">Search</button>
                    </form>
                </div>
                <button id="menu-btn"
                    onclick="showaside()" class="header-nav-element menu">
                    <div class="header-nav-elemnt-bar bar">
                </button>
                </div>

            </nav>
        </header> -->
        <main class="main">
            <section class="main-section" id="map">
                <form action="" class="main-section-form search hidden">
                    <input type="text" placeholder="Search" class="main-section-input">
                    <button class="main-section-btn">Search</button>
                </form>
            </section>
            <aside id="aside1" class="main-aside aside1">
                <div class="main-aside-credentials">
                    <h1>Verify as :</h1>
                <div class="main-aside-div credentials" id="studentverifybtn">Student</div>
                <div class="main-aside-div credentials" id="ownerverifybtn">Owner</div>
            </div>

          
            </aside>
            <aside id="aside2" class="main-aside aside2">
               
                    
            </aside>
            <div class="main-div student-verification hidden" id="student-verification">

                <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST" class="student-verification-form">
                    <h2 class="student-verification-form-h2" id="required-id">Error</h2>
                    <div class="input-field">
                        <label for="email">
                            <img src="/sajilo-rent/resources/user.png" alt="" height="50" width="50">
                        </label>
                        <input type="email" placeholder="Your email here" class="email" name="email" id="email">
                        <img src="/sajilo-rent/resources/key.png" alt="" height="50" width="50">
                        <input type="password"
                            placeholder="Enter your password" class="password" name="password" id="password">
                        <img src="/sajilo-rent/resources/combination.png" alt="" height="50" width="50">
                        <input type="number" class="verification-number" id="verification-number" placeholder="" name="verificationnumber" id="verificationnumber">
                        <input type="text" id="hidden-input" name="ownerorstudent" value="<?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                                                                                echo $_POST['ownerorstudent'];
                                                                                            } else {
                                                                                                echo '';
                                                                                            } ?>">
                        <input id="submit-button" type="submit" value="Verify">
                    </div>

                </form>
                <div id="hidden-info"><?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                            echo $verificationfailure;
                                        } else {
                                            echo '';
                                        } ?></div>
                <div id="hidden-info2"><?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                            echo $ownerorstudent;
                                        } else {
                                            echo '';
                                        } ?></div>
                <div id="hidden-info3"><?php if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                            echo $errorreason;
                                        } else {
                                            echo '';
                                        } ?></div>
            </div>
            <aside class="main-aside owner-verification">

            </aside>
        </main>
        <footer class="footer">
            &copy; Sajilo Rent.co
        </footer>
        <script src="/sajilo-rent/user-panel/script/user-home-script.js">
        </script>

        <!-- notification handling -->
        <script>
            function deleteCookie(name) {
                document.cookie = name + '=; expires=Thu, 01 Jan 1970 00:00:00 UTC; path=/;';
            }

            const notify = document.querySelector('.notification');

            function getCookie(name) {
                const cookies = document.cookie.split(';');
                for (let i = 0; i < cookies.length; i++) {
                    let cookie = cookies[i].trim();
                    if (cookie.startsWith(name + '=')) {
                        return cookie.substring(name.length + 1);
                    }
                }
                return null;
            }

            const myCookie = getCookie('msgs');
            if (myCookie) {
                setTimeout(() => {
                    notify.style = 'display:none';
                    deleteCookie('msgs'); // Use the correct cookie name here
                    window.location.href = "http://localhost/sajilo-rent/loginsignup_page/login.php";
                }, 10000);
                notify.style = 'display:unset';
                const msg = decodeURIComponent(myCookie);
                notify.innerText = msg;
            }
        </script>
    </body>

    </html>
