const body = document.body ;
const section = body.querySelector('section');
const dataBox = section.querySelector('.data_box')
const dataBlock = body.getElementsByClassName('data_block');
const  menu_btn = body.querySelector('.menu-btn');
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
    xmlhttp.open("GET", "http://localhost/sajilo-rent/user-panel/user-home.php?q="+`${encodeURIComponent(email)}`, true);
    
    xmlhttp.send(); // Send the encoded data
    xmlhttp.onload = function () {
        if (this.status === 200) {
            console.log("Response: " + this.responseText); // Log server response
        }
    };
}
//////////////// menu-btn redirection //////////
menu_btn.addEventListener('click',()=>{
    location.href = 'scaterplot.html';
})


//////////////////// admin-figure-btn //////////

const admin_btn = document.querySelector('.admin-btn');
const admin_bar = document.querySelector('.logout-bar');
document.addEventListener('click' , (e)=>{
    console.log(admin_btn.className);
    console.log(e.target.className);
    if(e.target.className===admin_btn.className){
        admin_bar.style="display:unset";
    }
    else {
        admin_bar.style="display:none";
    }
});
const logout_btn = document.querySelector('.log-out-btn');
logout_btn.addEventListener('click',()=>{
    console.log()
    location.href='../adminPanel'
})
