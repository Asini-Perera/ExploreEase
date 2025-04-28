// Image preview before upload
document.getElementById('rest-image').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        previewImage.src = URL.createObjectURL(file);
        previewContainer.style.display = 'block';
    }
});


 
    const dialog = document.getElementById('openDialog');
    const confirmButton = document.getElementById('confirm');
    const cancelButton = document.getElementById('cancel');
    const saveButton = document.querySelector('.submit-btn');
    const form = document.getElementById('uploadImage');

    saveButton.addEventListener('click', () => {
        dialog.showModal(); // Show the confirmation dialog
    });

    confirmButton.addEventListener('click', () => {
        dialog.close();
        form.submit(); // Submit the form when "Yes" is clicked
    });

    cancelButton.addEventListener('click', () => {
        dialog.close(); // Close the dialog on "No"
        window.location.href = 'http://localhost/ExploreEase/heritagemarket/dashboard?page=images'; // Redirect without saving
    });
 