import { Map, RoutingControl, MarkerMaker, SelectRanges } from './classes.js';

const center = [27.620339825608795, 85.5381077528];
const zoom = 20;
const tileLayer = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';
const attribution = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';

const map = new Map(center, zoom, tileLayer, attribution);
const mapInstance = map.createMap();

let markerMaker, routing, selecter;

fetch('/sajilo-rent/studentsection/backend/displayHouses.php')
    .then(response => response.json())
    .then(latlngData => {
        markerMaker = new MarkerMaker(mapInstance);
        routing = new RoutingControl(mapInstance, markerMaker, center);
        markerMaker.addMarkers(latlngData);
        selecter = new SelectRanges(mapInstance, markerMaker);
    })
    .catch(error => {
        console.error(`Error: ${error.message}`);
    });

mapInstance.on('popupopen', function(event) {
    console.log(event)
    const directionButton = event.popup._contentNode.querySelector('.directionButton');
    directionButton.addEventListener('click', () => {
        const lat = event.popup._source._latlng.lat;
        const lng = event.popup._source._latlng.lng;
        routing.addRoutingControl(lat, lng);
    });
});

mapInstance.on('popupopen', function(event) {
    const bookForRent = event.popup._contentNode.querySelector('.bookButton');
    const studentName = document.querySelector('.email').textContent;
    const contactDiv = event.popup._content.match(/Owner: <span class="bold">(.*?)<\/span>/);
    const ownerName = contactDiv[1];
    bookForRent.addEventListener('click', () => {
        fetch('/sajilo-rent/studentsection/backend/BookForRent.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({
                lat: event.popup._source._latlng.lat,
                lng: event.popup._source._latlng.lng,
                student: studentName,
                owner: ownerName 
            })
        })
        .then(response => response.json())
        .then(data => {
            alert(data.message);
        })
        .catch(error => {
            console.error('Error:', error);
        });
    });
});
mapInstance.on('popupopen', function(event) {
    const container = event.popup._contentNode;
    const lat = event.popup._source._latlng.lat;
    const lng = event.popup._source._latlng.lng;
    const coordinates = {
         "lat" : lat,
         "lng" : lng
    }
    if (container) {
        container.addEventListener('click', (e) => {
            // Check if the clicked element is a button
            if (!e.target.classList.contains('bookButton') && !e.target.classList.contains('directionButton')) {
                fetch('/sajilo-rent/studentsection/backend/displayDetails.php', {
                    method: "POST",
                    headers: {
                        "Content-type": "application/json"
                    },
                    body: JSON.stringify(coordinates)
                })
                .then(response => response.json())
                .then((data) => {
                    if (data.status === 'success') {
                        // Redirect to the details page
                        window.location.href = '/sajilo-rent/studentsection/details.php';
                    } else {
                        console.error('Error:', data.message);
                    }
                })
                .catch(error => console.error('Error:', error));

            }   

        });
    }

});

// navbar

document.querySelectorAll('.dropbtn').forEach(element =>{
   
    element.addEventListener('click',()=>{
        element.classList.toggle('active');
        const dropdownContent = element.nextElementSibling;
        dropdownContent.classList.toggle("show")
})});   

//select tags

