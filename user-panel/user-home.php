    <?php 
    if($_SERVER['REQUEST_METHOD'] === 'POST')
    {
        $password = $_POST['password'];
        $verificationnumber = $_POST['verificationnumber'];
        $email = $_POST['email'];
        $ownerorstudent = $_POST['ownerorstudent'];
        $conn = new mysqli('localhost' , 'root' , '' , 'user_database');
        $exists = false;
        $errorreason ='change';
        $username ='';
        if($conn->connect_error)
        {
            echo ''. $conn->connect_error;
        }
        else{
            $hashedPassword = password_hash($password , PASSWORD_DEFAULT);
            $query = 'SELECT firstName , lastName FROM signin WHERE email = ?';
            $stms = $conn->prepare($query);
            $stms->bind_param("s", $email);
            $stms->execute();
            $result = $stms->get_result();
            if($result->num_rows>0)
            {
                $row = $result->fetch_assoc();
                $exists = true;
                $verificationfailure = 'false';
                $username = $row['firstName'] . " " . $row['lastName'];
                $errorreason = 'account verified';
            }
            else{
                $exists = false;
                $verificationfailure = 'true';
                $errorreason = 'email or password error';
            }
        }
        $conn->close();
        $stms->close();
        $result->close();  
        $conn = new mysqli('localhost' , 'root' ,'' ,'user_database');
        if($exists)
        {
            if($conn->connect_error)
            {
                echo ''. $conn->connect_error;
            }
            else{
                $query = 'SELECT email FROM user_verification WHERE email = ?';
                $stms = $conn->prepare($query);
                $stms->bind_param('s', $email);
                $stms->execute();
                $result = $stms->get_result();
                if($result->num_rows> 0)
                {
                    $exists = false;
                    $verificationfailure = 'true';
                    $errorreason = 'email already verified';
                }
                else{
                    $exists = true;
                    $verificationfailure = 'false';
                    $errorreason = 'email verified';
                }
            }
            $conn->close();
            $stms->close();
            $result->close(); 
        }
        if($exists)
        {
            //////////////////////////////////////////////////////////////
        $conn = new mysqli('localhost' , 'root' ,'' ,'user_database');
        if($conn->connect_error)
        {
            echo ''. $conn->connect_error;
        }
        else{
            $query = 'INSERT INTO user_verification (email , verification_number , status) VALUES (?,?,?)';
            $stms = $conn->prepare($query);
            $stms->bind_param('sss', $email , $verificationnumber , $ownerorstudent);
            if ($stms->execute()) {
    
            $stms->close();
            $conn->close();
            session_start();
            $_SESSION['username'] = $username;
            $_SESSION['email'] = $email;
            header("Location:/sajilo-rent/user-panel/owner-page.php");

            } else {
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
        <title>Home Page</title>
        <link rel="icon" type="image/x-icon" href="/sajilo-rent/resources/logo.svg">
        <link rel="stylesheet" href="/sajilo-rent/user-panel/styles/user-home-style.css">
        <link rel="stylesheet" href="/sajilo-rent/universal-styling/style.css">
        <link rel="stylesheet" href="https://unpkg.com/leaflet@1.2.0/dist/leaflet.css"/>
        <link rel="stylesheet" href="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.css"/>
        <script src="https://unpkg.com/leaflet@1.2.0/dist/leaflet.js"></script>
        <script src="https://unpkg.com/leaflet-routing-machine@latest/dist/leaflet-routing-machine.js"></script>
    </head>
    <body>
        <header class="header">
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
                onclick="showaside()"  class="header-nav-element menu">
                <div class="header-nav-elemnt-bar bar">
                </button>
                </div>
            
            </nav>
        </header>
        <main class="main">
            <section class="main-section" id="map">
            <form action="" class="main-section-form search hidden">
                <input type="text" placeholder="Search" class="main-section-input">
                <button class="main-section-btn">Search</button>
            </form>
            </section>
            <aside id="aside1"class="main-aside aside1">
                <div class="main-aside-credentials">
                <figure>
                    <img src="/sajilo-rent/resources/logo.png" alt="Sajilo-Rent-logo" title="Sajilo-Rent-logo" height="50" width="50">
                </figure>
                
                <div class="main-aside-div credentials" id="studentverifybtn">Student</div>
                <div class="main-aside-div credentials" id="ownerverifybtn">Owner</div>
            </div>
            <h2 class="main-aside-h2">Find your perfect room</h2>
                <div class="main-aside-div slider">
                <div class="caption">Price</div>
                <div class="slidebar slide1">
                    <div class="ball"></div>  
                </div>
            
                </div>
                <div class="main-aside-div slider">
                <div class="caption">Distance</div>
                <div class="slidebar slide2">
                    <div class="ball"></div>  
                </div>
                
            </div>
                <div class="main-aside-div slider">
                <div class="caption">Rating</div>
                <div class="slidebar slide3">
                    <div class="ball"></div>  
                </div>
            
                </div>
            </aside>
            <aside id="aside2" class="main-aside aside2">
                <h2 class="main-aside-h2">Sajilo Rent</h2>
            <h3 class="main-aside-h3">Why Sajilo Rent<h3></h3> 
            <p class="main-aside-p info2">
                
                    
                        Welcome to Sajilo Rent – your one-stop solution for hassle-free renting! Whether you're looking for a place to stay, equipment for an event, or tools for your next project, Sajilo Rent connects you with trusted providers in just a few clicks. Enjoy a seamless renting experience with transparent pricing, verified listings, and reliable customer support. Renting has never been this easy – Sajilo Rent makes it simple!
                    
                </p>
            </aside>
            <div class="main-div student-verification hidden" id="student-verification">
                
                <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="POST" class="student-verification-form">
                    <h2 class="student-verification-form-h2" id="required-id">lol</h2>
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
                    <input type="text" id="hidden-input" name="ownerorstudent" value="<?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $_POST['ownerorstudent'];}else{echo '';}?>">
                    <input type="submit" value="Verify">
                    </div>
                
                </form>
                <div id="hidden-info"><?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $verificationfailure;}else{echo '';}?></div>
                <div id="hidden-info2"><?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $ownerorstudent;}else{echo '';}?></div>
                <div id="hidden-info3"><?php if($_SERVER['REQUEST_METHOD'] === 'POST'){echo $errorreason;}else{echo '';}?></div>
            </div>
            <aside class="main-aside owner-verification">

            </aside>
        </main> 
        <footer class="footer">
            &copy; Sajilo Rent.co
        </footer>
        <script src="/sajilo-rent/user-panel/script/user-home-script.js">
        </script>
    </body>
    </html>