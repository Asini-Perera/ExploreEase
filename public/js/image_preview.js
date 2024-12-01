function previewImage(event) {
    const reader = new FileReader();
    reader.onload = function() {
        const output = document.getElementById('currentProfileImage');
        output.src = reader.result;
    };
    reader.readAsDataURL(event.target.files[0]);
}