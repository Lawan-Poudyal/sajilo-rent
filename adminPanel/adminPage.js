const body = document.body ;
const section = body.querySelector('section');
const dataBox = section.querySelector('.data_box')
const dataBlock = body.getElementsByClassName('data_block');
const buttonClass =section.querySelector('.check-box').className;
function addGlobalEventListener(type , selector , callback , parent) {
parent.addEventListener(type , function(e) {
   if(e.target.className==='check-box'){
   callback(e.target.parentNode);
   }
});
}
addGlobalEventListener("click","check-box", verifyUser , dataBox);
function verifyUser(pNode) {
    const email = pNode.querySelector('span').textContent;
    console.log(email);
    pNode.remove();
    const xmlhttp = new XMLHttpRequest();
    xmlhttp.open("POST", "http://localhost/sajilo-rent/adminPanel/insert_verified_user.php", true);
    xmlhttp.setRequestHeader("Content-Type", "application/x-www-form-urlencoded"); // Set the content type
    
    // Prepare data in key=value&key2=value2 format
    const params = `email=${encodeURIComponent(email)}`; 
    
    xmlhttp.send(params); // Send the encoded data
    xmlhttp.onload = function () {
        if (this.status === 200) {
            console.log("Response: " + this.responseText); // Log server response
        }
    };
}
