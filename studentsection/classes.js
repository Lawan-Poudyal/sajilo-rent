let price = document.querySelector('.price');
let houseType = document.querySelector('.housetype');

class Map {
    constructor(center, zoom, tileLayer, attribution) {
        this.center = center;
        this.zoom = zoom;
        this.tileLayer = tileLayer;
        this.attribution = attribution;
    }

    createMap() {
        const mapInstance = L.map('map', {
            center: this.center,
            zoom: this.zoom
        });

        L.tileLayer(this.tileLayer, {
            attribution: this.attribution
        }).addTo(mapInstance);

        return mapInstance;
    }
}

class RoutingControl {
    constructor(mapInstance, markerMaker, center) {
        this.mapInstance = mapInstance;
        this.markerMaker = markerMaker;
        this.center = center;
        this.currentRoutingControl = null;
        this.removedMarkers = null;
        this.lat = null;
        this.lng = null;
    }

    addRoutingControl(lat, lng) {
        if (this.currentRoutingControl) {
            this.removeExistingRouting();
        }
        this.lat = lat;
        this.lng = lng;

        this.currentRoutingControl = L.Routing.control({
            waypoints: [
                L.latLng(lat, lng),
                L.latLng(this.center[0], this.center[1])
            ],
            draggableWaypoints: false
        }).addTo(this.mapInstance);

        this.markerMaker.removeMarker(lat, lng);
        this.displayCloseRouting();
    }

    removeExistingRouting() {
        if (this.currentRoutingControl) {
            this.mapInstance.removeControl(this.currentRoutingControl);
            const routingContainer = document.querySelector('.leaflet-routing-container');
            if (routingContainer) {
                routingContainer.style.display = 'none';
            }
            this.currentRoutingControl = null;
            this.markerMaker.addRemovedMarkers(this.lat, this.lng);
        }
    }

    displayCloseRouting() {
        const closeRouting = document.querySelector('.closeRouting');
        if (this.currentRoutingControl) {
            closeRouting.style.display = 'block';

            closeRouting.addEventListener('click', () => {
                this.removeExistingRouting();
                closeRouting.style.display = 'none';
            });
        } else {
            closeRouting.style.display = 'none';
        }
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
            if(location.BOOKED == 0){
                return;
            }
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
                    <button class = "bookButton">
                        Book for rent
                    </button>
                        <button class="directionButton">
                            Directions
                        </button>
                    </div>  
                </div>
            `;
            const popup = L.popup({
                maxWidth: 'auto',
                minWidth: 0
            }).setContent(content);

            const marker = L.marker([location.LAT, location.LNG], {
                icon: this.myIcon
            });
            marker.bindPopup(popup);
            marker.addTo(this.mapInstance);
            this.markerList.push(marker);
        })};
    

    addRemovedMarkers(removedLat, removedLng) {
        const removedMarker = this.markerList.find(marker => {
            const { lat: latToBeChecked, lng: LngToBeChecked } = marker.getLatLng();
            return removedLat == latToBeChecked && removedLng == LngToBeChecked;
        });
        if (removedMarker) {
            removedMarker.addTo(this.mapInstance);
        }
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
class SelectRanges {
    constructor(mapInstance, markerMaker) {
        this.mapInstance = mapInstance;
        this.markerMaker = markerMaker;
        this.removedMarker = [];
    }

    priceTags() {
        const priceValue = parseInt(price.value);

        this.markerMaker.markerList.forEach(marker => {
            let popupContent = marker.getPopup().getContent();
            let priceText = popupContent.match(/Price:\s*NRP\s*(\d+)/);

            if (priceText && priceText[1]) {
                if (parseInt(priceText[1]) > priceValue) {
                    this.removedMarker.push(marker);
                    this.mapInstance.removeLayer(marker);
                }
            }
        });
    }

    houseTypes() {
        this.priceTags();
        const houseValue = parseInt(houseType.value);

        if (isNaN(houseValue)) {
            this.addMarkers();
            return;
        }

        this.markerMaker.markerList.forEach(marker => {
            let popupContent = marker.getPopup().getContent();
            let houseText = popupContent.match(/Rooms:\s*(\d+)/);

            if (houseText && houseText[1]) {
                if (parseInt(houseText[1]) !== houseValue) {
                    this.removedMarker.push(marker);
                    this.mapInstance.removeLayer(marker);
                }
            }
        });
    }

    addMarkers() {
        this.removedMarker.forEach(marker => {
            marker.addTo(this.mapInstance);
        });
        this.removedMarker = [];
    }
}

export { Map, RoutingControl, MarkerMaker, SelectRanges };
