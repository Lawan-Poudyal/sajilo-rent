import {  RoutingControl, MarkerMaker, SelectRanges } from './classes.js';
import {mapInstance, center} from './main.js'

const markerMaker = new MarkerMaker(mapInstance);
const routingControl = new RoutingControl(mapInstance, markerMaker, center);


document.addEventListener('DOMContentLoaded', () => {
    const locationButtons = document.querySelectorAll('.js-location-button');

    locationButtons.forEach(button => {
        button.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent any unintended link navigation

            // Get latitude and longitude from data attributes
            const lat = parseFloat(button.getAttribute('data-room-lat'));
            const lng = parseFloat(button.getAttribute('data-room-lng'));

            if (!isNaN(lat) && !isNaN(lng)) {
                routingControl.addRoutingControl(lat, lng);
            } else {
                console.error("Invalid latitude or longitude");
            }
        });
    });




});



document.addEventListener('DOMContentLoaded', () => {


    let detailsButton = document.querySelectorAll(".js-details-button");


    detailsButton.forEach(button =>{
        button.addEventListener("click", ()=> {
            let lat = button.getAttribute("data-room-lat");
            let lng = button.getAttribute("data-room-lng");
    
            fetch('./backend/saveLatLng.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded'
                },
                body: 'latitude=' + lat + '&longitude=' + lng
            })
            .then(response => response.text())
            .then(data => {
                console.log(data);
                window.location.href = "./details.php"; 
            })
            .catch(error => console.error('Error:', error));
        });
    })
   
});