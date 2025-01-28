let leaveHouse;
let Json;
let modal;
let submitButton;
let reviewForm;

document.addEventListener("DOMContentLoaded", () => {
    leaveHouse = document.querySelector(".leaveButton");
    modal = document.querySelector(".review-container");
    submitButton = document.querySelector(".submit-button");
    reviewForm = document.querySelector(".review-form");
    
    if (leaveHouse) {
        leaveHouse.addEventListener('click', () => {
            modal.showModal();
        });
    }
    
    if (reviewForm) {
        processForm(reviewForm);
    }
    
    callBooked(); // Make sure this function is defined somewhere
});

function processForm(form) {
    form.addEventListener('submit', (e) => {
        e.preventDefault();
        const formData = new FormData(form);
        addReview(formData);

    });
}
function callBooked() {
        fetch('./backend/booked.php')
        .then(response => {
            if (!response.ok) {
                throw new Erroror('Invalid');
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
async function addReview(formData){

    const url1 = 'backend/addReviewHouse.php';
    const url2 = 'backend/addReview.php';

    const request1 = new Request(url1,{
            method: 'POST',
            body: formData
        })
    
    const request2 = new Request(url2,{
        method: 'POST',
        body: formData
    })

    const response = await Promise.all([fetch(request1),fetch(request2)]);
    const reponse1 = response[0];
    const reponse2 = response[1];
    if(reponse1.status == 'success' && reponse2.status == 'success'){
        alert("Successful review submission");
        leave();
    }

}