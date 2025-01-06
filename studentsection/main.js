import { Map, RoutingControl, MarkerMaker, SelectRanges } from './classes.js';

const center = [27.620339825608795, 85.5381077528];
const zoom = 20;
const tileLayer = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';
const attribution = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';

const map = new Map(center, zoom, tileLayer, attribution);
const mapInstance = map.createMap();

let markerMaker, routing, selecter;

fetch('./latlng.json')
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
    const directionButton = event.popup._contentNode.querySelector('.directionButton');
    directionButton.addEventListener('click', () => {
        const lat = event.popup._source._latlng.lat;
        const lng = event.popup._source._latlng.lng;
        routing.addRoutingControl(lat, lng);
    });
});

let price = document.querySelector('.price');
let houseType = document.querySelector('.housetype');

price.addEventListener('change', () => {
    selecter.addMarkers();
    selecter.priceTags();
});

houseType.addEventListener('change', () => {
    selecter.addMarkers();
    selecter.houseTypes();
});
