class Map {
    constructor(center, zoom, tileLayer, attribution) {
        // Initialize map properties
        this.center = center;          // The center coordinates of the map
        this.zoom = zoom;              // The zoom level for the map
        this.tileLayer = tileLayer;    // URL template for the map tiles
        this.attribution = attribution; // Attribution text for the map
    }

    createMap() {
        // Create the map instance with the specified center and zoom level
        const mapInstance = L.map('map', {
            center: this.center,
            zoom: this.zoom
        });

        // Add the tile layer with attribution to the map
        L.tileLayer(this.tileLayer, {
            attribution: this.attribution
        }).addTo(mapInstance);

        return mapInstance; // Return the map instance for further use
    }
}
class RoutingControl {
    constructor(mapInstance, markerMaker, center) {
        // Initialize routing-related properties
        this.mapInstance = mapInstance;  // Reference to the map instance
        this.markerMaker = markerMaker;  // Reference to the MarkerMaker instance
        this.center = center;            // Default center for routing
        this.currentRoutingControl = null; // Active routing control
        this.removedMarkers = null;       // Track removed markers
        this.lat = null;                  // Latitude of the current route
        this.lng = null;                  // Longitude of the current route
    }

    addRoutingControl(lat, lng) {
        // Add a routing control between the marker and the center
        if (this.currentRoutingControl) {
            this.removeExistingRouting(); // Remove existing routing if any
        }
        this.lat = lat;
        this.lng = lng;

        // Create the routing control
        this.currentRoutingControl = L.Routing.control({
            waypoints: [
                L.latLng(lat, lng),           // Start point (marker)
                L.latLng(this.center[0], this.center[1]) // End point (center)
            ],
            draggableWaypoints: false       // Disable waypoint dragging
        }).addTo(this.mapInstance);
        this.markerMaker.removeMarker(lat, lng); // Remove the marker for the route
        this.displayCloseRouting();             // Display the close button for the route
    }

    removeExistingRouting() {
        // Remove the existing routing control
        if (this.currentRoutingControl) {
            this.mapInstance.removeControl(this.currentRoutingControl); // Remove the control
            const routingContainer = document.querySelector('.leaflet-routing-container');
            if (routingContainer) {
                routingContainer.style.display = 'none'; // Hide the routing container
            }
            this.currentRoutingControl = null; // Reset the control to null
            markerMaker.addRemovedMarkers(this.lat, this.lng); // Re-add the marker
        }
    }

    displayCloseRouting() {
        // Display the close routing button
        if (this.currentRoutingControl) {
            const closeRouting = document.querySelector('.closeRouting');
            closeRouting.style.display = 'block';

            closeRouting.addEventListener('click', () => {
                this.removeExistingRouting(); // Remove the routing control on click
                closeRouting.style.display = 'none'; // Hide the close button
            });
        } else {
            closeRouting.style.display = 'none'; // Hide the close button if no routing
        }
    }
}
class MarkerMaker {
    constructor(mapInstance) {
        // Initialize marker-related properties
        this.mapInstance = mapInstance; // Reference to the map instance
        this.myIcon = L.icon({
            iconUrl: '../resources/marker.svg', // Custom marker icon
            iconSize: [30, 30]                 // Icon size
        });
        this.markerList = []; // List to store all created markers
    }

    addMarkers(latlngData) {
        // Add multiple markers to the map using data from latlngData array
        latlngData.forEach(location => {
            // Generate popup content dynamically using location data
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

            // Create a popup for the marker
            const popup = L.popup({
                maxWidth: 'auto', // Set popup width
                minWidth: 0       // Minimum width
            }).setContent(content);

            // Create a marker and bind the popup to it
            const marker = L.marker([location.LAT, location.LNG], {
                icon: this.myIcon
            });
            marker.bindPopup(popup);
            marker.addTo(this.mapInstance); // Add the marker to the map
            this.markerList.push(marker);  // Store the marker in the marker list
        });
        console.log(this.markerList); // Log all markers for debugging
    }

    addRemovedMarkers(removedLat, removedLng) {
        // Re-add a previously removed marker to the map
        console.log(`LatR: ${removedLat} LngR: ${removedLng}`);
        const removedMarker = this.markerList.find(marker => {
            const { lat: latToBeChecked, lng: LngToBeChecked } = marker.getLatLng();
            return removedLat == latToBeChecked && removedLng == LngToBeChecked;
        });
        console.log(removedMarker);
        removedMarker.addTo(this.mapInstance); // Add the marker back to the map
    }

    removeMarker(lat, lng) {
        // Remove a marker from the map by its coordinates
        const marker = this.markerList.find(element => {
            const { lat: markerLat, lng: markerLng } = element.getLatLng();
            return markerLat === lat && markerLng === lng;
        });
        if (marker) {
            this.mapInstance.removeLayer(marker); // Remove the marker from the map
        } else {
            console.warn(`Marker not found at coordinates: ${lat}, ${lng}`);
        }
    }
    
}

class SelectRanges {
    constructor(mapInstance, markerMaker) {
        // Initialize the mapInstance and markerMaker for future operations
        this.mapInstance = mapInstance; // Reference to the map instance
        this.markerMaker = markerMaker; // Reference to the MarkerMaker instance
        this.removedMarker = []; // Array to store removed markers temporarily
    }

    priceTags() {
        // Function to filter markers based on the price input value
        const priceValue = parseInt(price.value); // Parse the input price value as a number

        // Iterate through the list of markers
        this.markerMaker.markerList.forEach((marker) => {
            // Get the content of the popup associated with the marker
            let popupContent = marker.getPopup().getContent();

            // Extract the price from the popup content using regex
            let priceText = popupContent.match(/Price:\s*NRP\s*(\d+)/);

            // If the price is found in the content, check if it exceeds the filter value
            if (priceText && priceText[1]) {
                // If the price is greater than the input value, remove the marker
                if (parseInt(priceText[1]) > priceValue) {
                    // Push the marker into the removedMarker array for potential re-addition
                    this.removedMarker.push(marker);
                    // Remove the marker from the map
                    this.mapInstance.removeLayer(marker);
                }
            }
        });
    }

    houseTypes() {
        // Function to filter markers based on the house type (number of rooms)
        const houseValue = parseInt(houseType.value); // Get the house value from input and convert to integer
        console.log(houseValue);

        // Check if the house value is valid (not NaN)
        if (isNaN(houseValue)) {
            // If no valid house value is selected, re-add previously removed markers and exit
            this.addMarkers();
            return;
        }

        // Iterate through the list of markers
        this.markerMaker.markerList.forEach((marker) => {
            // Get the content of the popup associated with the marker
            let popupContent = marker.getPopup().getContent();
            // Extract the number of rooms from the popup content
            let houseText = popupContent.match(/Rooms:\s*(\d+)/);

            // If the number of rooms is found in the content, check if it matches the filter value
            if (houseText && houseText[1]) {
                // If the number of rooms does not match the filter value, remove the marker
                if (parseInt(houseText[1]) !== houseValue) {
                    // Push the marker into the removedMarker array
                    this.removedMarker.push(marker);
                    // Remove the marker from the map
                    this.mapInstance.removeLayer(marker);
                }
            }
        });
    }

    addMarkers() {
        // Function to re-add markers that were previously removed
        this.removedMarker.forEach((marker) => {
            // Re-add each removed marker back to the map
            marker.addTo(this.mapInstance);
        });
    }
}



// Creating a Map object with specific configurations
const center = [27.620339825608795, 85.5381077528]; // Map center coordinates
const zoom = 20;                                     // Initial zoom level
const tileLayer = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png'; // Tile layer URL
const attribution = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'; // Attribution text

const map = new Map(center, zoom, tileLayer, attribution);
const mapInstance = map.createMap(); // Create the map instance

// Fetching data from latlng.json and adding markers and popups
let markerMaker, routing,selecter;
fetch('./latlng.json')
.then(response => response.json()) // Parse the JSON response
.then(latlngData => {
    markerMaker = new MarkerMaker(mapInstance); // Create a MarkerMaker instance
    routing = new RoutingControl(mapInstance, markerMaker, center); // Create a RoutingControl instance
    markerMaker.addMarkers(latlngData); // Add markers to the map
    selecter = new SelectRanges(mapInstance,markerMaker);
})
.catch(error => {
    console.error(`Error: ${error.message}`); // Handle fetch errors
});

// Add event listener for opening a popup
mapInstance.on('popupopen', function(event) {
    const directionButton = event.popup._contentNode.querySelector('.directionButton');
    directionButton.addEventListener('click', () => {
        const lat = event.popup._source._latlng.lat;
        const lng = event.popup._source._latlng.lng;
        routing.addRoutingControl(lat, lng); // Add routing control for the clicked marker
    });
});

//creating a select object
let price = document.querySelector('.price');
let houseType = document.querySelector('.housetype');
price.addEventListener('change', () => {
    selecter.addMarkers();
    selecter.priceTags();
});
houseType.addEventListener('change',()=>{
    selecter.addMarkers();
    selecter.houseTypes();
})
