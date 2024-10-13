document.addEventListener('DOMContentLoaded', function () {
    console.log("JS file loaded");
    
    const form = document.querySelector('form');
    if (form) {
        console.log("Form found");

        form.onsubmit = function(event) {
            event.preventDefault();  // Prevent actual form submission for validation
            console.log("Form submitted");

            const adminID = document.getElementById('AdminID').value;
            const password = document.getElementById('password').value;

            console.log("AdminID: ", adminID);
            console.log("Password: ", password);

            // Basic validation: Check if fields are not empty
            if (!adminID) {
                alert("AdminID is required");
                return false;
            }

            if (!password) {
                alert("Password is required");
                return false;
            }

            // Additional validation rules (e.g., length, format)
            if (password.length < 6) {
                alert("Password must be at least 6 characters long");
                return false;
            }

            // If everything is valid, allow form submission
            alert("Form is valid! Submitting...");
            form.submit();  // Submit the form if validation passes
        };
    } else {
        console.error("Form not found");
    }
});
