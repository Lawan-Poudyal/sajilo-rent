
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
  if(isShown2 ===false && width>=996)
  {
  document.getElementById('aside2').style.display = 'block';
  isShown2=true;
  }
  else if (isShown2===true && width>=996)
  {
    document.getElementById('aside2').style.display = 'none';
  isShown2=false;
  }
  }
  
  window.addEventListener('resize', function () {
    let width=window.innerWidth;
    let aside1 = this.document.getElementById('aside1');
    let aside2 = this.document.getElementById('aside2');
    if(isShown2 === false && width >=996)
    {
      aside2.style.display = 'none';
    }
    else{
      aside2.style.display = 'block';
    }
    if(isShown === false && width >=768)
    {
      aside1.style.display = 'none';
    }
    else{
      aside1.style.display = 'block';
    }
    

  });
  /*******************************/
  const box = document.getElementById('student-verification');
  const ownerverifybutton = document.getElementById('ownerverifybtn');
  const studentverifybutton = document.getElementById('studentverifybtn')
  const fullbody = document.querySelector('body');
  const map = document.getElementById('map');
  const aside1 = document.getElementById('aside1');
  const aside2 = document.getElementById('aside2');
  const heading = document.getElementById('required-id');
  const verificationnumber = document.getElementById('verification-number');
  const hiddeninfo = document.getElementById('hidden-info');
  let isdisplayed =false;
  let ownerorstudent = document.getElementById('hidden-info2');
  let verifyfor = document.getElementById('hidden-input');
  let errorreason = document.getElementById('hidden-info3');
  ownerverifybutton.addEventListener('click', function(){
    heading.innerText = "Owner verification";
    verificationnumber.placeholder = "Owner verification number";
    /////////////////////////
    box.style.display = 'block';
    map.style.filter = 'blur(25px)';
    aside1.style.filter = 'blur(25px)';
    aside2.style.filter = 'blur(25px)'; 
    verifyfor.value = "owner";

    
  });
 
  studentverifybutton.addEventListener('click', function(){
    heading.innerText = "Student verification";
    verificationnumber.placeholder = "Student verification number";
    /////////////////////////
    box.style.display = 'block';
    map.style.filter = 'blur(25px)';
    aside1.style.filter = 'blur(25px)';
    aside2.style.filter = 'blur(25px)'; 
    verifyfor.value = "student";
  });
if(ownerorstudent.innerText === 'student')
{
heading.innerText = "Student verification";
verificationnumber.placeholder = "Student verification number";
document.getElementById('email').placeholder = errorreason.innerText;
document.getElementById('password').placeholder = errorreason.innerText;
document.getElementById('verification-number').placeholder =errorreason.innerText;
}
else if(ownerorstudent.innerText === 'owner')
{
heading.innerText = "Owner verification";
verificationnumber.placeholder = "Owner verification number";
document.getElementById('email').placeholder = errorreason.innerText;
document.getElementById('password').placeholder = errorreason.innerText;
document.getElementById('verification-number').placeholder =errorreason.innerText;
}  
if(hiddeninfo.innerText === 'true')
{
document.getElementById('email').style.border = "1px solid red";
document.getElementById('password').style.border = "1px solid red";
document.getElementById('verification-number').style.border = "1px solid red";

/////////////////////////
box.style.display = 'block';
map.style.filter = 'blur(25px)';
aside1.style.filter = 'blur(25px)';
aside2.style.filter = 'blur(25px)'; 
verifyfor.value = "student";
}
else if(hiddeninfo.innerText === 'false')
{
  document.getElementById('email').style.border = "1px solid green";
document.getElementById('password').style.border = "1px solid green";
document.getElementById('verification-number').style.border = "1px solid green";
heading.innerText = "Student verification";
verificationnumber.placeholder = "Student verification number";
/////////////////////////
box.style.display = 'block';
map.style.filter = 'blur(25px)';
aside1.style.filter = 'blur(25px)';
aside2.style.filter = 'blur(25px)'; 
verifyfor.value = "student";
}
  document.addEventListener('click', function (event) {
    const isClickInsideBox = box.contains(event.target); // Check if click is inside the verification box
    const isOwnerButton = ownerverifybutton.contains(event.target);
    const isStudentButton = studentverifybutton.contains(event.target);

    if (!isClickInsideBox && !isOwnerButton && !isStudentButton) {
        box.style.display = 'none';
        map.style.filter = 'none';
        aside1.style.filter = 'none';
        aside2.style.filter = 'none';
    }
});
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
 