<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>


    <link rel="stylesheet" href="./universal-styling/page-header.css">
    </link>

    <link rel="stylesheet" href="./student-scroll-section/styles/general.css">
    </link>
</head>

<body>


    <header>
        <div class="header-left-section">
            <div>
                <a class="header-link" href="./scroll.html">
                    <img src="./resources/logo.svg" class="sajilo-rent-logo" />
                    <img src="./resources/logo.png" class="sajilo-rent-mobile-logo" />
                </a>
            </div>
        </div>


        <div class="header-middile-section">
            <!-- <div class="search-bar-container"> -->

            <input type="text" placeholder="Search" class="search-bar" />

            <button class="filter-btn" onclick="toggleFilters()">
                <img src="./resources/filter-icon-black.png" alt="Filter" class="filter-icon">
            </button>
            <button class="search-btn">
                <img src="./resources/search-icon.png" alt="Search" class="search-icon">
            </button>


            <!-- </div> -->

            <div id="filter-container" class="filters hidden">

                <div class="filter-option">
                    <label for="price">Price Range:</label>
                    <select id="price" class="filter-select">
                        <option value="10000" selected>All</option>
                        <option value="3000">3000</option>
                        <option value="3500">3500</option>
                        <option value="4000">4000</option>
                        <option value="4500">4500</option>
                        <option value="5000">5000</option>
                        <option value="5500">5500</option>
                        <option value="6000">6000</option>
                    </select>
                </div>

                <div class="filter-option">
                    <label for="type">Type:</label>
                    <select id="type" class="filter-select">
                        <option value="" selected>All</option>
                        <option value="1">Single Room</option>
                        <option value="2">Double Room</option>
                        <option value="3">Triple Room</option>
                        <option value="4">Appartment</option>
                    </select>
                </div>
            </div>



        </div>
        <div class="header-right-section">
            <a class="map-link header-link">

                <img class="map-icon" src="./resources/map-icon.png" />

                <span class="map-text">Map</span>
            </a>

            <a class="profile-link header-link" href="#">
                <img class="profile-icon" src="./resources/profile-icon-white.png" />
                <span class="profile-text">Profile</span>
            </a>

        </div>
    </header>


    <script>
        // script.js

        function toggleFilters() {
            const filterContainer = document.getElementById('filter-container');
            filterContainer.classList.toggle('hidden');
        }

        document.addEventListener('click', function(event) {
            const filterContainer = document.getElementById('filter-container');
            const filterButton = document.querySelector('.filter-btn');

            // Check if the click is outside the filter container and the button
            if (!filterContainer.contains(event.target) && !filterButton.contains(event.target)) {
                filterContainer.classList.add('hidden');
            }
        });
    </script>

</body>

</html>