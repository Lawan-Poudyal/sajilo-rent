<?php 

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Messenger</title>
    <link rel="stylesheet" href="/sajilo-rent/chatapplication/style/messenger-style.css">
    <link rel="stylesheet" href="/sajilo-rent/universal-styling/style.css">
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:400,600" rel="stylesheet">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/meyer-reset/2.0/reset.min.css">
</head>
<body>
<div class="sidebar">
        <h2>Contacts</h2>
        <ul class="contacts js-contacts">
            <li>User 1</li>
            <li>User 2</li>
            <li>User 3</li>
        </ul>
    </div>
    <div class="chat-container">
        <div class="chat-header js-chat-headaer">User 1</div>
        <div class="chat-box" id="chatBox">
<!---------------------- messages will be displayed here ----------------------->
        </div>
        <div class="chat-input">
            <input type="text" id="messageInput" placeholder="Type a message...">
            <button class='js-send-btn'>Send</button>
        </div>
    </div>
    <script src="/sajilo-rent/chatapplication/script/messenger-script.js"></script>
</body>
</html>