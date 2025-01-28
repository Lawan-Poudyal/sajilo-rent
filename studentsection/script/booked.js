let leaveHouse;
let Json;
let modal;

document.addEventListener("DOMContentLoaded", () => {
    leaveHouse = document.querySelector(".leaveButton");
    modal = document.querySelector(".review-container");
    const textarea = document.querySelector(".writeText");
    // if (textarea) {
    //     textarea.addEventListener("click", () => {
    //         // Set the cursor position to the top-left corner
    //         textarea.setSelectionRange(0, 0);
    //     });
    // }
    if(leaveHouse){
    leaveHouse.addEventListener('click',()=>{
        modal.showModal();
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
