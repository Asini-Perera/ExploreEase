<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultural Event Organizer Signup</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/signup_form.css">
</head>

<body>
    <div class="container">
        <div class="signup-box">
            <h2>Cultural Event Organizer Signup</h2>
            <p>provide your details correctly to create an account</p>

            <?php
            // Display error message if failed to sign up
            if (isset($_SESSION['error'])) {
                echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']); // Clear the error message
            }
            ?>

            <form action="signup/culturaleventorganizer" method="post">
                <div class="input-group">
                    <label for="name">Name *</label>
                    <input type="text" id="name" name="name" required><br><br>
                </div>
                <div class="input-group">
                    <label for="email">Email *</label>
                    <input type="email" id="email" name="email" required><br><br>
                </div>
                <div class="input-group">
                    <label for="password">Password *</label>
                    <input type="password" id="password" name="password" required><br><br>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Confirm Password *</label>
                    <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                </div>
                <div class="input-group">
                    <label for="contactNo">Contact Number</label>
                    <input type="text" id="contactNo" name="contactNo"><br><br>
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"></textarea><br><br>
                </div>
                <div class="input-group">
                    <label for="smlink">Social Media Link:</label>
                    <input type="url" id="smlink" name="smlink" value=""><br><br>
                </div>
                <div class="input-group">
                    <label for="profile_image">Profile Image:</label>
                    <input type="file" id="profile_image" name="profile_image"><br><br>
                </div>

                <button type="submit">Next</button>
            </form>
        </div>
    </div>

    <script src="public/js/background_slideshow1.js"></script>
    <script src="public/js/signup_validation.js"></script>
</body>

</html>