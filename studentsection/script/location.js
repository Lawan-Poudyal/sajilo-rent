const locationButton = document.querySelectorAll('.js-location-button');

locationButton.forEach((button)=>{

    button.addEventListener("click", ()=>{

         const lat = button.getAttribute('data-room-lat');
         const lng = button.getAttribute('data-room-lng');

        // Save the location in the backend
        fetch('/sajilo-rent/studentsection/backend/saveLocation.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ lat: parseFloat(lat), lng: parseFloat(lng) })
        })
        .then(response => response.json())
        .then(data => {
            if (data.status === 'success') {
                // Redirect to the map page
                window.location.href = '/sajilo-rent/studentsection/displayLatLng.php';
            } else {
                console.error('Error:', data.message);
            }
        })
        .catch(error => console.error('Error:', error));

            
    });

});
