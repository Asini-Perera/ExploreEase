const dialog = document.getElementById('openDialog');
const confirmButton = document.getElementById('confirm');
const cancelButton = document.getElementById('cancel');
const deleteButtons = document.querySelectorAll('.reject-btn');
let currentForm = null;

deleteButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent the default form submission
        currentForm = button.closest('form'); // Get the form associated with the clicked button
        dialog.showModal(); // Show the confirmation dialog
    });
});

confirmButton.addEventListener('click', () => {
    if (currentForm) {
        const actionInput = currentForm.querySelector('input[name="action"]');
        if (actionInput) {
            actionInput.value = 'reject'; // Set the actual value
        }
        dialog.close();
        currentForm.submit(); // Now the form submits with action=reject
    }
});


cancelButton.addEventListener('click', () => {
    dialog.close(); // Close the dialog on "No"
});