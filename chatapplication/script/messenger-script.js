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
status = url.searchParams.get('status');
async function sendMessage() {
    if (input.value.trim() === "") return;
    const messageDiv = document.createElement("div");
    messageDiv.classList.add("message", "sent");
    messageDiv.textContent = input.value;
    chatBox.appendChild(messageDiv);
    // const threeDot = document.createElement("img");
    // threeDot.setAttribute('src' , 'https://img.icons8.com/?size=100&id=21622&format=png&color=FFFFFF');
    // threeDot.classList.add('three-dot,js-three-dot');
    // messageDiv.appendChild(threeDot);
    // const toolTip = document.createElement("div");
    // toolTip.innerHTML = `<ul class='ul-tool-tip js-ul-tool-tip '><li>Delete</li><li>Unsend</li> </ul>`;
    // toolTip.classList.add('hidden');
    // messageDiv.appendChild(toolTip);
    // threeDot.addEventListener('click' , ()=>{
    //     toolTip.classList.toggle('hidden');
    // });
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


async function loadPeople(){
    let response;
    if(status === 'owner')
    {
    response = await fetch(`/sajilo-rent/user-panel/back_end/loadtenants.php?email=${email}`);
    }
    else{
    response = await fetch(`/sajilo-rent/chatapplication/backend/loadowner.php`);
    }
    chat_data = await response.json();
    console.log(chat_data);
}
async function peopleName(){
    await loadPeople();
    let nameHTML = ` `;
    chat_data.forEach(chat => {
        
        nameHTML += `
         <li class="tenants js-tenants" data-tenant= '${chat['email']}'>
                <div class="contact-box">
                    <div class="small-image js-small-image"></div>
                    <div class="username">${chat['username']}</div>
                </div> 
            </li>
        `
    });
    contacts.innerHTML = nameHTML;
    const chatters = document.querySelectorAll('.js-small-image');
    chatters.forEach((chatter , index)=>{
        let filepath = '';
        if(status === 'owner')
        {
            filepath = '/sajilo-rent/studentsection/backend/';
        }else{
            filepath = '/sajilo-rent/user-panel/back_end/';
        }
        filepath = filepath + chat_data[index]['image'];
        chatter.style.backgroundImage = `url('${filepath}')`;
        chatter.style.backgroundImage = 'cover';
    });
 

}

async function addClickOpt(){
   
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
console.log(data);
data.forEach(chat =>{
 if(chat['sender'] === email){
    loadChatMsg(true , chat);
 }
 else{
    loadChatMsg(false , chat);
 }
 
});

}

 function loadChatMsg(sentOrRecieved , chat)
{
let msg = chat['message'];
const messageDiv = document.createElement("div");  
if(sentOrRecieved === true)
{
    messageDiv.classList.add("message", "sent");
    messageDiv.textContent = msg;
    chatBox.appendChild(messageDiv);
    const threeDot = document.createElement("img");
    threeDot.setAttribute('src' , 'https://img.icons8.com/?size=100&id=21622&format=png&color=FFFFFF');
    threeDot.classList.add('three-dot,js-three-dot');
    messageDiv.appendChild(threeDot);
    const toolTip = document.createElement("div");
    toolTip.innerHTML = `<ul class='ul-tool-tip js-ul-tool-tip hidden'><li >Change</li><li class='delete-msg js-delete-msg' data-id='${chat['id']}'>Unsend</li></ul>`;
    toolTip.classList.add('hidden');
    messageDiv.appendChild(toolTip);
    threeDot.addEventListener('click' , ()=>{
        toolTip.classList.toggle('hidden');
    });
    const deleteMsg = messageDiv.querySelector('.js-delete-msg');
    deleteMsg.addEventListener('click' , async (e)=>{
        const msgBoxDiv = e.target.closest('div').parentNode;
        await removeMsg(msgBoxDiv , deleteMsg.dataset['id']);
    });
}
else{
    messageDiv.classList.add("message","received");
    messageDiv.textContent = msg;
    chatBox.appendChild(messageDiv);
}

chatBox.scrollTop = chatBox.scrollHeight;
}

async function sendToDataBase(reciever , msg){
let response = await fetch(`/sajilo-rent/chatapplication/backend/insertintochat.php?sender=${email}&reciever=${reciever}&message=${input.value.trim()}`);
let text = await response.text();
console.log(text);
input.value = '';
}
async function removeMsg(msgBoxDiv ,  id)
{
    let response = await fetch(`/sajilo-rent/chatapplication/backend/removemsg.php?id=${id}`);
    let data = await response.text();
    console.log(data);
    msgBoxDiv.remove();
}
async function jaskfl(){
const repsonse = await loadChat(reciever);
}// setInterval(async () => {
//   } , 1000);