class Map {
    constructor(center, zoom, tileLayer, attribution) {
        this.center = center;
        this.zoom = zoom;
        this.tileLayer = tileLayer;
        this.attribution = attribution;
    }

    createMap() {
        // Create the map instance
        const mapInstance = L.map('map', {
            center: this.center,
            zoom: this.zoom
        });

        // Add the tile layer to the map
        L.tileLayer(this.tileLayer, {
            attribution: this.attribution
        }).addTo(mapInstance);

        return mapInstance;
    }
}

class MarkerMaker {
    constructor(mapInstance) {
        this.mapInstance = mapInstance;
        this.myIcon = L.icon({
            iconUrl: '../resources/marker.svg',
            iconSize: [30, 30]
        });
    }

    addMarkers(latlngData) {
        latlngData.forEach(location => {
            // Generate the popup content dynamically
            const content = `
                <div class="top-div"></div>  
                <div class="bottom-div"> 
                    <div class="left-div"></div>  
                    <div class="right-div"></div>  
                </div> 
                <div class="infocontainer">
                    <div class="quickinfo">
                        <div class="housetype">Rooms: ${location.ROOMSAVAILABLE}</div>
                        <div class="price">Price: NRP ${location.PRICE}</div>
                        <div class="contact">Contact: ${location.CONTACT}</div>
                    </div>
                    <div class="button">
                        <button class="directionButton">
                            <img src="../resources/direction.svg" alt="Directions">
                            Directions
                        </button>
                    </div>
                </div>
            `;

            // Create the popup
            const popup = L.popup({
                maxWidth: 'auto',
                minWidth: 0
            }).setContent(content);

            // Create the marker and bind the popup
            const marker = L.marker([location.LAT, location.LNG], {
                icon: this.myIcon
            });
            marker.bindPopup(popup);
            marker.addTo(this.mapInstance);
        });
    }
}

// Creating a Map object
const center = [27.620339825608795, 85.5381077528];
const zoom = 20;
const tileLayer = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';
const attribution = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';

const map = new Map(center, zoom, tileLayer, attribution);
const mapInstance = map.createMap();

// Fetching data from latlng.json and adding markers and popups
fetch('./latlng.json')
    .then(response => response.json())
    .then(latlngData => {
        const markerMaker = new MarkerMaker(mapInstance);
        markerMaker.addMarkers(latlngData);
    })
    .catch(error => {
        console.error(`Error: ${error.message}`);
    });
