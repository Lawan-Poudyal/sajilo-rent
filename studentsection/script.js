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
        this.markerList = [];
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
            this.markerList.push(marker);
        });
    }

    removeMarker(lat, lng) {
        const marker = this.markerList.find(element => {
            const { lat: markerLat, lng: markerLng } = element.getLatLng();
            return markerLat === lat && markerLng === lng;
        });
        if (marker) {
            this.mapInstance.removeLayer(marker);
        } else {
            console.warn(`Marker not found at coordinates: ${lat}, ${lng}`);
        }
    }
}

class RoutingControl {
    constructor(mapInstance, markerMaker, center) {
        this.mapInstance = mapInstance;
        this.markerMaker = markerMaker;
        this.center = center;
        this.currentRoutingControl = null;
    }

    addRoutingControl(lat, lng) {
        console.log("Before addRoutingControl:", this.currentRoutingControl);
        if (this.currentRoutingControl) {
            console.log("Removing existing routing control...");
            this.removeExistingRouting();
        }

        // Ensure the routing control is being correctly assigned
        this.currentRoutingControl = L.Routing.control({
            waypoints: [
                L.latLng(lat, lng),
                L.latLng(this.center[0], this.center[1])
            ],
            draggableWaypoints: false
        }).addTo(this.mapInstance);

        console.log("After adding routing control:", this.currentRoutingControl);

        this.markerMaker.removeMarker(lat, lng);
    }

    removeExistingRouting() {
        console.log("Removing existing routing control...");
        if (this.currentRoutingControl) {
            this.mapInstance.removeControl(this.currentRoutingControl);
            const routingContainer = document.querySelector('.leaflet-routing-container');
            if (routingContainer) {
                routingContainer.style.display = 'none';
            }
            this.currentRoutingControl = null;  // Reset the control to null
        }
    }
}

// Creating a Map object
const center = [27.620339825608795, 85.5381077528];
const zoom = 20;
const tileLayer = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';
const attribution = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';

const map = new Map(center, zoom, tileLayer, attribution);
const mapInstance = map.createMap();

let markerMaker,routing;
// Fetching data from latlng.json and adding markers and popups
fetch('./latlng.json')
    .then(response => response.json())
    .then(latlngData => {
        markerMaker = new MarkerMaker(mapInstance);
        routing = new RoutingControl(mapInstance,markerMaker,[27.620339825608795, 85.5381077528]);
        markerMaker.addMarkers(latlngData);
    })
    .catch(error => {
        console.error(`Error: ${error.message}`);
    });


mapInstance.on('popupopen', function(event) {
    const directionButton = event.popup._contentNode.querySelector('.directionButton');
    directionButton.addEventListener('click', () => {
        const lat = event.popup._source._latlng.lat;
        const lng = event.popup._source._latlng.lng;
        
        routing.addRoutingControl(lat, lng);
    });
});