import { Map, RoutingControl, MarkerMaker, SelectRanges } from './classes.js';

// const locationButton = document.querySelector('.js-location-button');

// locationButton.addEventListener("click", (event)=>{
   
//     console.log(event);
// });


const center = [27.620339825608795, 85.5381077528];
const zoom = 20;
const tileLayer = 'https://tile.openstreetmap.org/{z}/{x}/{y}.png';
const attribution = '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>';

const map = new Map(center, zoom, tileLayer, attribution);
const mapInstance = map.createMap();

let markerMaker, routingLocation;

markerMaker = new MarkerMaker(mapInstance);

routingLocation = new RoutingControl(mapInstance, markerMaker, center);
const lat = 27.61970291051658;
const lng = 85.53646624088287;

routingLocation.addRoutingControl(lat, lng);