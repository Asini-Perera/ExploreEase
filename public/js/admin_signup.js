document.addEventListener("DOMContentLoaded", function () {
    const form = document.querySelector("form");
    const password = document.getElementById("password");
    const confirmPassword = document.getElementById("confirm_password");
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
