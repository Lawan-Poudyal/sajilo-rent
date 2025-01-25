let leaveHouse;
let Json;

document.addEventListener("DOMContentLoaded", () => {
    leaveHouse = document.querySelector(".leaveButton");
    console.log(leaveHouse); // Check if the element is successfully selected
    if(leaveHouse){
    leaveHouse.addEventListener('click',()=>{
        leave();
    })}

    callFetch();
});

function callFetch() {
    console.log("hi");
    fetch('./backend/booked.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Invalid');
            }
            return response.json();
        })
        .then(json => {
            if (!json.status) {
                Json = json;
                console.log("hi");
                updateGharbeti();
            }
        })
        .catch(console.warn);
}

function updateGharbeti() {
    const coordinates = {
        lat: Json.latitude,
        lng: Json.longitude,
    };
    console.log("hi");
    leaveHouse.style.display = 'block';
}
const leave = ()=>{
    console.log("hi")
    fetch("./backend/leave.php", {
        method: 'POST',
        headers: {
            "Content-type": "application/json"
        },
        body: JSON.stringify({
            latitude: Json.latitude,
            longitude: Json.longitude
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.status === 'success') {
            console.log('Successfully left the house');
            leaveHouse.display.style = 'none'
        } else {
            console.error('Error:', data.message);

        }
    })
    .catch(error => console.error('Error:', error));
};

