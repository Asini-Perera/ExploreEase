<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Market Signup</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/signup_form.css">
</head>

<body>
    <div class="container">
        <div class="signup-box">
            <h2>Heritage Market Signup</h2>
            <p>provide your details correctly to create an account</p>

            <?php
            // Display error message if failed to sign up
            if (isset($_SESSION['error'])) {
                echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']); // Clear the error message
            }
            ?>

            <form action="signup/heritagemarket" method="post">
                <div class="input-group">
                    <label for="name">Name *</label>
                    <input type="text" id="name" name="name" required><br><br>
                </div>
                <div class="input-group">
                    <label for="address">Address *</label>
                    <input type="text" id="address" name="address" required><br><br>
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
                    <label for="website">Heritage Market Website</label>
                    <input type="url" id="website" name="website"><br><br>
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"></textarea><br><br>
                </div>
                <div class="input-group">
                    <label for="open_hours">Open Hours</label>
                    <input type="text" id="open_hours" name="openhours"><br><br>
                </div>
                <div class="input-group">
                    <label for="smlink">Social Media Links</label>
                    <input type="url" id="smlink" name="smlink"><br><br>
                </div>

                <button type="submit">Next</button>
            </form>
        </div>
    </div>

    <script src="public/js/background_slideshow1.js"></script>
    <script src="public/js/signup_validation.js"></script>
</body>

</html>