
const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('slideIn3');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.5 
  });
  
  const sliders = document.querySelectorAll('.slide3');
  sliders.forEach(slider => {
    observer.observe(slider); 
  });
  /*********************************/
  const observer2 = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('slideIn1');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.5 
  });
  
  const sliders2 = document.querySelectorAll('.slide1');
  
  sliders2.forEach(slider => {
    observer2.observe(slider); 
  });
  /**********************************/
  const observer3 = new IntersectionObserver((entries, observer) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('slideIn2');
        observer.unobserve(entry.target);
      }
    });
  }, {
    threshold: 0.5 
  });
  
  const sliders3 = document.querySelectorAll('.slide2');
  
  sliders3.forEach(slider => {
    observer3.observe(slider); 
  });
  /*****************************************/
  
  let isShown = false;
  function showaside(){
  let width= window.innerWidth;
  if(isShown ===false && width>=768)
  {
  document.getElementById('aside1').style.display = 'block';
  isShown=true;
  }
  else if (isShown===true && width>=768)
  {
    document.getElementById('aside1').style.display = 'none';
  isShown=false;
  }
  }
  let isShown2 = false;
  function showaside2(){
  let width= window.innerWidth;
  if(isShown2 ===false && width>=768)
  {
  document.getElementById('aside2').style.display = 'block';
  isShown2=true;
  }
  else if (isShown2===true && width>=768)
  {
    document.getElementById('aside2').style.display = 'none';
  isShown2=false;
  }
  }
  
  window.addEventListener('resize', function () {
    let width=window.innerWidth;
      if(width < 768)
  {
    document.getElementById('aside2').style.display = 'block';
    document.getElementById('aside1').style.display = 'block';
    var text = 'minecraft';
    
  }
  else if(width >=768)
  {
    document.getElementById('aside2').style.display = 'none';
    document.getElementById('aside1').style.display = 'none';
  }
  });
  /*******************************/
  function studentverifybox()
  {
    document.getElementById('student-verification').style.display="block";
    document.getElementById('map').style.filter="blur(25px)";
    document.getElementById('aside1').style.filter="blur(25px)";
    document.getElementById('aside2').style.filter="blur(25px)";
  }
  /*****************************/
  // Getting the geolocation for ourown house right now 
  let lat, long;
  
  if (navigator.geolocation) {
      navigator.geolocation.getCurrentPosition(
          (position) => {
              // Extract latitude and longitude from position
              lat = position.coords.latitude;
              long = position.coords.longitude;
  
              // Initialize the map after coordinates are retrieved
              const map = L.map('map').setView([27.6194, 85.5388], 15); // Set initial view
  
              // Add OpenStreetMap tile layer
              L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
                  attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
              }).addTo(map);
  
              // Add markers
              const locker = L.marker([lat, long]).addTo(map);
              locker.bindPopup("<b>Your Location!</b><br><button class='marker-button'>Rent!</button>").openPopup();
  
              const marker = L.marker([27.6194, 85.5388]).addTo(map);
              marker.bindPopup("<b>Rent your Room!</b><br><button class='marker-button'>Rent!</button>").openPopup();
  
              // Add routing
              L.Routing.control({
                  waypoints: [
                      L.latLng(27.6194, 85.5388),
                      L.latLng(lat, long)
                  ]
              }).addTo(map);
          },
          (error) => {
              console.error("Error getting geolocation:", error.message);
          }
      );
  } else {
      console.error("Geolocation is not supported by this browser.");
  }