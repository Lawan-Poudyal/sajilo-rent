const map = L.map('map', {
    center: [27.620339825608795, 85.5381077528],
    zoom: 20
});

L.tileLayer('https://tile.openstreetmap.org/{z}/{x}/{y}.png', {
    attribution: '&copy; <a href="http://www.openstreetmap.org/copyright">OpenStreetMap</a>'
}).addTo(map);

const myIcon = L.icon({
    iconUrl:'../resources/marker.svg',
    iconSize: [30, 30],
})

function onEachFeature(feature) {
    const lat = feature.geometry.coordinates[1];
    const lng = feature.geometry.coordinates[0];


    const marker = L.marker([lat, lng], {
        icon: myIcon
    });

    const price = feature.properties.price; 
    const rooms = feature.properties.rooms;
    const contact = feature.properties.contact;
    
    const popup = L.popup({
        maxWidth: 'auto',
        minWidth: 0
    }).setContent(`
        <div class="top-div"></div>  
        <div class="bottom-div"> 
            <div class="left-div"></div>  
            <div class="right-div"></div>  
        </div> 
        <div class ="infocontainer">
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
}


L.geoJSON(houseLocations, {
    onEachFeature: onEachFeature
});


