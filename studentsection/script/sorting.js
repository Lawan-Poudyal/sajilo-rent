// document.addEventListener('DOMContentLoaded', function() {
//     // Price dropdown elements
//     const priceDropdown = document.getElementById("priceDropdown");
//     const roomDropdown = document.getElementById("roomsDropdown");
//     const roomsContainer = document.querySelector(".room-container-grid");

//     // Event listener for price filter
//     priceDropdown.addEventListener('click', function(e) {
//         if (e.target.classList.contains('price-option')) {
//             const price = e.target.getAttribute('data-value');
//             filterRooms(price, null); // Filter by price, no room filter
//         }
//     });

//     // Event listener for room filter
//     roomDropdown.addEventListener('click', function(e) {
//         if (e.target.classList.contains('room-option')) {
//             const rooms = e.target.getAttribute('data-value');
//             filterRooms(null, rooms); // Filter by rooms, no price filter
//         }
//     });

//     // Function to filter rooms via AJAX
//     function filterRooms(price, rooms) {
//         const xhr = new XMLHttpRequest();
//         const url = '/sajilo-rent/student-scroll-section/prev-data-generation.php';
//         let params = [];

//         if (price) params.push('price=' + price);
//         if (rooms) params.push('rooms=' + rooms);

//         // Send AJAX request
//         xhr.open('GET', url + '?' + params.join('&'), true);
//         xhr.onreadystatechange = function() {
//             if (xhr.readyState === 4 && xhr.status === 200) {
//                 // Update room list with the new results
//                 roomsContainer.innerHTML = xhr.responseText;
//             }
//         };
//         xhr.send();
//     }
// });



// document.addEventListener('DOMContentLoaded', function() {
//     // Price dropdown elements
//     const priceDropdown = document.getElementById("priceDropdown");
//     const roomDropdown = document.getElementById("roomsDropdown");
//     const resetFiltersButton = document.getElementById("resetFiltersButton");
//     const roomsContainer = document.querySelector(".room-container-grid");

//     // Event listener for price filter
//     priceDropdown.addEventListener('click', function(e) {
//         if (e.target.classList.contains('price-option')) {
//             const price = e.target.getAttribute('data-value');
//             filterRooms(price, null); // Filter by price, no room filter
//         }
//     });

//     // Event listener for room filter
//     roomDropdown.addEventListener('click', function(e) {
//         if (e.target.classList.contains('room-option')) {
//             const rooms = e.target.getAttribute('data-value');
//             filterRooms(null, rooms); // Filter by rooms, no price filter
//         }
//     });

//     // Event listener for the reset button
//     resetFiltersButton.addEventListener('click', function() {
//         // Reset the dropdown selections to default (or initial state)
//         resetDropdowns();

//         // Call filterRooms without any parameters to reload all rooms
//         filterRooms(null, null);
//     });

//     // Function to reset the dropdown selections
//     function resetDropdowns() {
//         // Reset price filter (adjust as needed for your structure)
//         const defaultPriceOption = priceDropdown.querySelector('.price-option');
//         if (defaultPriceOption) {
//             priceDropdown.querySelector('.active').classList.remove('active');
//             defaultPriceOption.classList.add('active');
//         }

//         // Reset rooms filter (adjust as needed for your structure)
//         const defaultRoomOption = roomDropdown.querySelector('.room-option');
//         if (defaultRoomOption) {
//             roomDropdown.querySelector('.active').classList.remove('active');
//             defaultRoomOption.classList.add('active');
//         }
//     }

//     // Function to filter rooms via AJAX
//     function filterRooms(price, rooms) {
//         const xhr = new XMLHttpRequest();
//         const url = '/sajilo-rent/student-scroll-section/prev-data-generation.php';
//         let params = [];

//         if (price) params.push('price=' + price);
//         if (rooms) params.push('rooms=' + rooms);

//         // Send AJAX request
//         xhr.open('GET', url + '?' + params.join('&'), true);
//         xhr.onreadystatechange = function() {
//             if (xhr.readyState === 4 && xhr.status === 200) {
//                 // Update room list with the new results
//                 roomsContainer.innerHTML = xhr.responseText;
//             }
//         };
//         xhr.send();
//     }
// });
