const MAP_CONFIG = {
    defaultCenter: [27.620339825608795, 85.5381077528],
    defaultZoom: 20,
    tileLayerUrl: 'https://tile.openstreetmap.org/{z}/{x}/{y}.png'
};

const map = L.map('map', {
    center: MAP_CONFIG.defaultCenter,
    zoom: MAP_CONFIG.defaultZoom
}); 

L.tileLayer(MAP_CONFIG.tileLayerUrl, {
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

const myIcon = L.icon({
    iconUrl: '../resources/marker.svg',
    iconSize: [30, 30],
});

const markers = {};
const removedMarkers = [];
let count = 0;
let currentRoutingControl = null; // Variable to store the current routing control

  //Working with the select tags

    //price 

let priceList = document.querySelector('.price');
let selectedPrice = parseFloat(priceList.value); 

priceList.addEventListener('change',()=>{
    selectedPrice = parseFloat(priceList.value);
    console.log(selectedPrice);
    for (const key in markers) {
        if (markers.hasOwnProperty(key)) {
            map.removeLayer(markers[key]);
        }
    }
    Object.keys(markers).forEach(key => delete markers[key]);
    getHouseLocations();

})
//room tags
let roomList = document.querySelector('.houseType');
let selectedRoom = parseInt(roomList.value);

roomList.addEventListener('change', () => {
    selectedRoom = parseInt(roomList.value);
    for (const key in markers) {
        if (markers.hasOwnProperty(key)) {
            map.removeLayer(markers[key]);
        }
    }
    Object.keys(markers).forEach(key => delete markers[key]);
    getHouseLocations();
});

function onEachFeature(feature) {
    const lat = feature.geometry.coordinates[1];
    const lng = feature.geometry.coordinates[0];
    const key = `${lat},${lng}`;
    const marker = L.marker([lat, lng], {
        icon: myIcon
    });

    const price = feature.properties.price;
    const rooms = feature.properties.rooms;
    const contact = feature.properties.contact;

    let selectedRooms = [];
    if (isNaN(selectedRoom)) {
        selectedRooms = [1, 2, 3, 4]; // Default to all possible room numbers
    } else {
        selectedRooms = [selectedRoom];
    }

    if (selectedPrice >= price && selectedRooms.includes(rooms)) {
        const popup = L.popup({
            maxWidth: 'auto',
            minWidth: 0
        }).setContent(`
            <div class="top-div"></div>  
            <div class="bottom-div"> 
                <div class="left-div"></div>  
                <div class="right-div"></div>  
            </div> 
            <div class="infocontainer">
                <div class="quickinfo">
                    <div class="housetype">Rooms: ${rooms}</div>
                    <div class="price">Price: NRP ${price}</div>
                    <div class="contact">Contact: ${contact}</div>
                </div>
            
                <div class="button">
                    <button class="directionButton">
                        <img src="../resources/direction.svg" alt="Directions">
                        hi
                    </button>
                </div>
            </div>
        `);

        marker.bindPopup(popup);
        marker.addTo(map);
        markers[key] = marker;
    }
}

const getHouseLocations = () => {
    L.geoJSON(houseLocations, {
        onEachFeature: onEachFeature
    });
};

getHouseLocations();

map.on('popupopen', function(event) {
    const directionButton = event.popup._contentNode.querySelector('.directionButton');
    directionButton.addEventListener('click', () => {

        const lat = event.popup._source._latlng.lat;
        const lng = event.popup._source._latlng.lng;
        createMarker(removedMarkers);
        calculateDistance(lat, lng);

    });
});
const createMarker = (removedMarkers) => {
        removedMarkers.forEach(element => {
            const [lat,lng] = element.split(",");
            const key = `${lat},${lng}`;
            const marker = L.marker([lat,lng],{
                icon : myIcon
            })
            const popup = markers[key]._popup._content;
            marker.bindPopup(popup).addTo(map);
            
        });
}

const calculateDistance = (lat, lng) => {
    if (currentRoutingControl) {
        // Remove the existing routing control if it exists
        map.removeControl(currentRoutingControl);
        const routingAlt = document.querySelector('.leaflet-routing-container');
        if (routingAlt) {
            routingAlt.style.display = 'none';
        }
    }

    // Create a new routing control
    currentRoutingControl = L.Routing.control({
        waypoints: [
            L.latLng(lat, lng), 
            L.latLng(27.620339825608795, 85.5381077528)
        ],
        draggableWaypoints: false
    }).addTo(map);

    const key = `${lat},${lng}`;
    removedMarkers.push(key);

    if (markers[key]) {
        map.removeLayer(markers[key]); // Remove the marker from the map
    }
};





