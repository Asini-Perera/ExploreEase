const dialog = document.getElementById('openDialog');
const confirmButton = document.getElementById('confirm');
const cancelButton = document.getElementById('cancel');
const saveButton = document.querySelector('.btn');
const form = document.getElementById('updateForm');

saveButton.addEventListener('click', () => {
    dialog.showModal(); // Show the confirmation dialog
});

confirmButton.addEventListener('click', () => {
    dialog.close();
    form.submit(); // Submit the form when "Yes" is clicked
});

cancelButton.addEventListener('click', () => {
    dialog.close(); // Close the dialog on "No"
    form.reset(); // Reset the form to its original state
});