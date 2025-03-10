let currentIndex = 0;

function showSlide(index) {
    const slider = document.getElementById('slider');
    const slides = document.querySelectorAll('.slider img');
    if (index >= slides.length) currentIndex = 0;
    else if (index < 0) currentIndex = slides.length - 1;
    else currentIndex = index;
    slider.style.transform = `translateX(-${currentIndex * 100}%)`;
}

function nextSlide() {
    showSlide(currentIndex + 1);
}

function prevSlide() {
    showSlide(currentIndex - 1);
}

function goBack() {
    window.history.back();
}


const bookButton = document.querySelector(".js-book-button");
bookButton.addEventListener('click', () => {

    let lat = bookButton.getAttribute("data-room-lat");
    let lng = bookButton.getAttribute("data-room-lng");
    let ownerName = bookButton.getAttribute("data-room-owner");
    let studentName = bookButton.getAttribute("data-student-name");
    console.log(lat , lng, ownerName);

    fetch('/sajilo-rent/studentsection/backend/bookForRent.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            lat: lat,
            lng: lng,
            student: studentName,
            owner: ownerName 
        })
    })
    .then(response => response.json())
    .then(data => {
        if(data.message.match("Exception")){
            alert("Rent request already sent");
        }
        else{
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
    });
});