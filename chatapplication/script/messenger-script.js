const send_btn = document.querySelector('.js-send-btn');
let chat_data;
const contacts = document.querySelector('.js-contacts');
const input = document.getElementById("messageInput");
const chatBox = document.getElementById("chatBox");
let timeoutfunc;
let reciever;
let status;
let seenornot = true;
// VARAIBLES//  
const url = new URL(window.location.href);
const email = url.searchParams.get('email');
async function sendMessage() {
    if (input.value.trim() === "") return;
    const messageDiv = document.createElement("div");
    messageDiv.classList.add("message", "sent");
    messageDiv.textContent = input.value;
    chatBox.appendChild(messageDiv);
    chatBox.scrollTop = chatBox.scrollHeight;
    input.value = '';
}
send_btn.addEventListener('click' , ()=>{
sendToDataBase(reciever , input.value);
sendMessage();
});
/// backend calling /////////


/// initialize every function before//
addClickOpt();
//////////////////////////////////////

async function getStatus(){
    let response = await fetch(`/sajilo-rent/chatapplication/backend/getstatus.php?email=${email}`);
    return await response.text();
  
}

async function loadPeople(){
   
    let response = await fetch(`/sajilo-rent/user-panel/back_end/loadtenants.php?email=${email}`);
    chat_data = await response.json();
    console.log(chat_data);
}
async function peopleName(){
    await loadPeople();
    let nameHTML = ` `;
    chat_data.forEach(chat => {
        
        nameHTML += `
         <li class="tenants js-tenants" data-tenant ='${chat['email']}'>${chat['username']}</li>
        `
    });
   contacts.innerHTML = nameHTML;

}

async function addClickOpt(){
    status = await getStatus();
    console.log(status);
    await peopleName();
    let tenants = document.querySelectorAll('.js-tenants');
    tenants.forEach(btn =>{
        btn.addEventListener('click' , (event)=>{
        reciever = btn.dataset.tenant;
        seenornot = true;
       loadChat(reciever);
    });
});
}


async function loadChat(reciever){
    let response = await fetch(`/sajilo-rent/chatapplication/backend/loadchat.php?sender=${email}&reciever=${reciever}&status=${status}`);
let data= await response.json();
if(status === 'student' && seenornot === false)
    {
    if(data[data.length-1]['seenornot'] ==='studentseen' || data[data.length-1]['seenornot'] === 'seen') return;
    }
    else if(status === 'owner' && seenornot ===false){
        if(data[data.length-1]['seenornot'] ==='ownerseen' || data[data.length-1]['seenornot'] === 'seen') return;
    }
    chatBox.innerHTML = '';
    seenornot =false;
console.log(data[data.length-1]['seenornot']);
console.log(status);
console.log(data);
data.forEach(chat =>{
 if(chat['sender'] === email){
    loadChatMsg(true , chat['message']);
 }
 else{
    loadChatMsg(false , chat['message']);
 }
 
});

}

function loadChatMsg(sentOrRecieved , msg)
{
const messageDiv = document.createElement("div");  
if(sentOrRecieved === true)
{
    messageDiv.classList.add("message", "sent");
}
else{
    messageDiv.classList.add("message", "received");
}
messageDiv.textContent = msg;
chatBox.appendChild(messageDiv);
chatBox.scrollTop = chatBox.scrollHeight;
}

async function sendToDataBase(reciever , msg){
let response = await fetch(`/sajilo-rent/chatapplication/backend/insertintochat.php?sender=${email}&reciever=${reciever}&message=${input.value.trim()}`);
input.value = '';
}

setInterval(async () => {
    await loadChat(reciever);
  } , 1000);