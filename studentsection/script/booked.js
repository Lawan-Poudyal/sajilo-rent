const gharbetis = document.querySelector(".main-item.main-section");
const commentsection = document.querySelector(".commentsection");
const comments = document.querySelector(".comments");

if(window.location.pathname == '/sajilo-rent/studentsection/student-profile.php'){
    console.log(gharbetis)
    gharbetis.textContent = "You have no owner, you are free"; 
    commentsection.style.display = 'none';
    comments.style.display = 'none';
}
let Json;
// setInterval(callFetch,5000);
function callFetch(){
    {fetch('./backend/booked.php')

        .then(response => {
            if(!response.ok){
                throw new Error('Invalid')
            }
            return response.json()
        })
        .then(json => {
            if(!json.status){
                Json = json;
                updateGharbeti()
            }})
        .catch(console.warn);
        }
}   
callFetch();
function updateGharbeti() {
    console.log(Json);
    const coordinates = {
        lat: Json.latitude,
        lng: Json.longitude,
    };

    fetch('./backend/displayDetails.php', {
        method: "POST",
        headers: {
            "Content-type": "application/json"
        },
        body: JSON.stringify(coordinates)
    })
    .then(response => response.json())
    .then((data) => {
        if (data.status === 'success') {
            // Redirect to the details page
        } else {
            console.error('Error:', data.message);
        }
    })
    .catch(error => console.error('Error:', error));

    // Dynamically update the DOM
    gharbetis.innerHTML = `
        <div>Owner: ${Json.username}</div>
        <a class="details" href="./details.php">Details</a>
        <button class="leaveHouse">Leave your owner and free yourself</button>
    `;

    // Add the event listener after the button is added to the DOM
    const leaveHouse = document.querySelector(".leaveHouse");
    leaveHouse.addEventListener('click', () => {
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
                // Handle success
                console.log('Successfully left the house');
                gharbetis.textContent = "You have no owner, you are free"; 
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));
    });
}
