const gharbetis = document.querySelector(".main-item.main-section");
const commentsection = document.querySelector(".commentsection");
const comments = document.querySelector(".comments");

if(window.location.pathname == '/sajilo-rent/studentsection/student-profile.php'){
    console.log(gharbetis)
    gharbetis.textContent = "You have no owner, you are free"; 
    commentsection.style.display = 'none';
    comments.style.display = 'none';
}
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
                updateGharbeti(json)
            }})
        .catch(console.warn);
        }
}
callFetch();

function updateGharbeti(json){
    console.log(json);
    const coordinates = {
        lat : json.latitude,
        lng: json.longitude,
    }
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

    gharbetis.innerHTML = `<div>Owner: ${json.username}</div>
                            <a class = "details" href = "./details.php">Details</a>`;


}   