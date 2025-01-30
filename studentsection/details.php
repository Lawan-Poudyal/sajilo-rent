<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href= "./styles/details.css" rel="stylesheet">
</head>
<?php
session_start();
$houseDetails = isset($_SESSION['houseDetails']) ? $_SESSION['houseDetails'] : null;
?>
<script>
    const houseData = <?php echo json_encode($houseDetails); ?>;
</script>
<script src="./script/displayDetails.js" defer></script>
<script>
    document.addEventListener("DOMContentLoaded", () => {
        if (houseData && houseData.length > 0) {
            displayTheDatas(houseData[0]);
        }
    });
</script>

<body>
    <nav>
        <button class="menu">menu</button>
        <div class="leftSide">
            <button class="signup">Signup/Signin</button>
            <button class="profile">profile</button>
            <div class="userInformation" >
                <div class="email"><?php echo $_SESSION['s_email']; ?></div>
                <div class="userName"><?php echo $_SESSION['s_username']?></div>
            </div>
        </div>
    </nav>
    
    <section class="image">
        <div class="displayimage">
            <div class="mainimage">

            </div>
            <div class="sideimage">
                <div class="topimage">

                </div>
                <div class="bottomimage">

                </div>
            </div>
        </div>
    </section>
    <div class="flexit">
        <aside>
             <div class="contact">
                <p class="contactline">Contact the room</p>
                <button class="rent">
                    Book for rent
                </button>
                <button class="message">
                    Message
                </button>
                <div class="contactat">
                    <i class="fa-solid fa-phone"></i>
                    9238403928
                </div>
            </div>
        </aside>
        <div>
            <section class="details">
                <div class="owner">Name</div>
                <div class="info">
                    <div class="price">

                        <div class="priceTag">MonthlyRent</div>
                        <div class="monthlyRent">Rs.5000</div>
                    </div>
                    <div class="rooms">
                        <div class="roomTag">Room</div>
                        <div class="availableRoom">2</div>
                    </div>
                </div>
                <div class="features">
                    <p>Room Features</p>
                    <ul>
                        <li>Electricty: <span class = "electricity"></span></li>
                        <li>Sunlight: <span class="sunlight"></span></li>
                        <!-- do the same here -->
                        <li>Parking: <span class="parking"></span></li>
                        <li>Balcony: <span class="balcony"></span></li>
                        <li>Wifi Price: <span class="wifiPrice"></span></li>
                        <li>Roomates: <span class="roomates"></span></li>
                        <li>Floor Level: <span class="floorLevel"></span></li>
                        <li>House Facing Direction: <span class="houseFacingDirection"></span></li>
                        <li>Gates Open At:<span class="gatesOpenAt"></span></li>
                        <li>Gates Close At:<span class="gatesCloseAt"></span></li>
                    </ul>
                </div>
            </section>
            <section class>
                <div class="review">
                    <div class="overall">
                        4 out of 5
                    </div>
                    <div class="writeReview">
                        <p>Share your experience</p>
                        <button class="giveReview">Write a Review</button>
                    </div>
                </div>
                <div class="recentReviews">
                    <div class="left">
                    </div>
                    <div class="right">
                    </div>
                </div>
            </section>
        </div>
    </div>
    <footer>
        sajilorent copyright 2025
    </footer>
</body>
</html>