document.querySelectorAll('input[required], textarea[required]').forEach(element => {
    element.addEventListener('blur', () => {
        if (!element.value.trim()) {
            element.style.border = '2px solid #d8000c';
            element.style.backgroundColor = '#ffcccc';
            element.placeholder = 'This field is required';
        } else {
            element.style.border = '2px solid #006600';
            element.style.backgroundColor = '#ccffcc';
        }
        element.style.transition = 'border 0.3s, background-color 0.3s';
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const password = document.getElementById("newPassword");
    const confirmPassword = document.getElementById("confirmPassword");
    const errorMessages = [];

    form.addEventListener("submit", function (event) {
        errorMessages.length = 0; // Clear previous error messages

        // Validate password length
        if (password.value.length < 6) {
            errorMessages.push("Password must be at least 6 characters long.");
        }

        // Validate password match
        if (password.value !== confirmPassword.value) {
            errorMessages.push("Passwords do not match.");
        }

        // Check if there are any errors
        if (errorMessages.length > 0) {
            event.preventDefault(); // Prevent form submission
            alert(errorMessages.join("\n")); // Show error messages
        }
    });
});
