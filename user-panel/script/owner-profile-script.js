const changeProfileBtn = document.querySelector('.js-change-profile-icon');
const imageInput  = document.querySelector('.js-image-input');


changeProfileBtn.addEventListener('click' , ()=>{
imageInput.click();
});
imageInput.addEventListener('change', async ()=>{
    const file = imageInput.files[0];
    if (file) {
        const formData = new FormData();
        formData.append('image', file);
        try {
            const response = await fetch('/sajilo-rent/user-panel/owner-profile.php', {
                method: 'POST',
                body: formData
            });

            if (response.ok) {
                // Reload the page to show the updated profile image
                window.location.reload();
            } else {
                alert('Image upload failed.');
            }
        } catch (error) {
            console.error('Error uploading image:', error);
        }
    }
   

});