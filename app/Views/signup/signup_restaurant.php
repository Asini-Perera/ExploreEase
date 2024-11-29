<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Signup</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/signup_form.css">
</head>

<body>
    <div class="container">
        <div class="signup-box">
            <h2>Restaurant Signup</h2>
            <p>provide your details correctly to create an account</p>

            <?php
            // Display error message if failed to sign up
            if (isset($_SESSION['error'])) {
                echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']); // Clear the error message
            }
            ?>

            <form action="restaurant_signupform.php" method="post">
                <div class="input-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required><br><br>
                </div>
                <div class="input-group">
                    <label for="location">Location:</label>
                    <input type="text" id="location" name="location" required><br><br>
                </div>
                <div class="input-group">
                    <label for="contactNo">Contact Number:</label>
                    <input type="text" id="contactNo" name="contactNo"><br><br>
                </div>
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required><br><br>
                </div>
                <div class="input-group">
                    <label for="website">Website:</label>
                    <input type="url" id="website" name="website" value=""><br><br>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required><br><br>
                </div>
                <div class="input-group">
                    <label for="confirm_password">Confirm Password:</label>
                    <input type="password" id="confirm_password" name="confirm_password" required><br><br>
                </div>
                <div class="input-group">
                    <label for="open_hours">Open Hours:</label>
                    <input type="text" id="open_hours" name="openhours" value=""><br><br>
                </div>
                <div class="input-group">
                    <label for="cuisine_types">Cuisine Type:</label>
                    <input type="text" id="cuisine_types" name="cuisinetype" value=""><br><br>
                </div>

                <button type="submit" formaction="keyword">Next</button>
            </form>
        </div>
    </div>

    <script src="public/js/background_slideshow1.js"></script>
</body>

</html>