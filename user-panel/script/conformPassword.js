
function checkPassword(event) {
    const password = document.getElementById("password").value;
    const confirmPassword = document.getElementById("confirmPassword").value;

    if (password !== confirmPassword) {
        // alert("Passwords do not match!");
        document.querySelector(".error-message").innerHTML = `<span style="color:red;">Passwords do not match!</span>`
        event.preventDefault(); // Prevent form submission
       return false; // Return false to indicate failure
    }
    return true; // Allow form submission
}
// //---------------------------------------------------------------------------------------------------------------------------
// var doc=document.getElementById("SignUpButton");
// doc.addEventListener("click",function(event) {
//     const password = document.getElementById("password").value;
//     const confirmPassword = document.getElementById("confirmPassword").value;

//     if (password !== confirmPassword) {
//         alert("Passwords do not match!");
//         event.preventDefault();
//     } 
// });