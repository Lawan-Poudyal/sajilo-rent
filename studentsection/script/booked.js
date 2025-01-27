let leaveHouse;
let Json;

document.addEventListener("DOMContentLoaded", () => {
    leaveHouse = document.querySelector(".leaveButton");
    if(leaveHouse){
    leaveHouse.addEventListener('click',()=>{
        leave();
    })}

    callFetch();
});

function callFetch() {
    fetch('./backend/booked.php')
        .then(response => {
            if (!response.ok) {
                throw new Error('Invalid');
            }
            return response.json();
        })
        .then(json => {
                if(json.status != 'error'){
                    Json = json;
                    leaveHouse.classList.add('show');
                }
                
        })
        .catch(console.warn);
}
const leave = ()=>{
    leaveHouse.classList.remove('show');
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
        .then(response => response.text())
        .then(data => {
            if (data.status == 'success') {
                console.log('Successfully left the house');
            } 
        })
        .catch(error => console.error('Error:', error));
    };

