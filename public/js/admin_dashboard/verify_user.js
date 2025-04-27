const verifyDialog = document.getElementById('openDialog-verify');
const rejectDialog = document.getElementById('openDialog-reject');
const confirmVerifyButton = document.getElementById('confirm-verify');
const cancelVerifyButton = document.getElementById('cancel-verify');
const confirmRejectButton = document.getElementById('confirm-reject');
const cancelRejectButton = document.getElementById('cancel-reject');
const verifyButtons = document.querySelectorAll('.verify-btn');
const rejectButtons = document.querySelectorAll('.reject-btn');
let currentForm = null;
let actionInput = null;

// Open Verify Dialog
verifyButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        currentForm = button.closest('form');
        actionInput = currentForm.querySelector('input[name="action"]');
        verifyDialog.showModal();
    });
});

// Confirm Verify
confirmVerifyButton.addEventListener('click', () => {
    if (currentForm && actionInput) {
        actionInput.value = 'verify';
        verifyDialog.close();
        currentForm.submit();
    }
});

cancelVerifyButton.addEventListener('click', () => {
    verifyDialog.close();
});

// Open Reject Dialog
rejectButtons.forEach(button => {
    button.addEventListener('click', (event) => {
        currentForm = button.closest('form');
        actionInput = currentForm.querySelector('input[name="action"]');
        rejectDialog.showModal();
    });
});

// Confirm Reject
confirmRejectButton.addEventListener('click', () => {
    if (currentForm && actionInput) {
        actionInput.value = 'reject';
        rejectDialog.close();
        currentForm.submit();
    }
});

cancelRejectButton.addEventListener('click', () => {
    rejectDialog.close();
});