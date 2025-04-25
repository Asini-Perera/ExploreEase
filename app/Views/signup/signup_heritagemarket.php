<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Market Signup</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/signup_form.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHabPak9APZk-8qvZs4j_qNkTl_Pk0aF8"></script>

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
                    <label>Pin Heritage Market Location on Map *</label>
                    <div id="map"></div>
                </div>

                <input type="hidden" id="latitude" name="latitude" value="0" required>
                <input type="hidden" id="longitude" name="longitude" value="0" required>

                <div class="input-group">
                    <label for="contactNo">Contact Number *</label>
                    <input type="text" id="contactNo" name="contactNo" required><br><br>
                </div>
                <div class="input-group">
                    <label for="website">Heritage Market Website</label>
                    <input type="url" id="website" name="website"><br><br>
                </div>
                <div class="input-group">
                    <label for="description">Description *</label>
                    <textarea id="description" name="description" required></textarea><br><br>
                </div>
                <div class="input-group">
                    <label for="weekdays_openhours">Weekdays Open Hours *</label>
                    <input type="text" id="weekdays_openhours" name="weekdays_openhours" required><br><br>
                </div>
                <div class="input-group">
                    <label for="weekends_openhours">Weekends Open Hours *</label>
                    <input type="text" id="weekends_openhours" name="weekends_openhours" required><br><br>
                </div>
                <div class="input-group">
                    <label for="tagline">Tagline *</label>
                    <input type="text" id="tagline" name="tagline" required><br><br>
                </div>
                <div class="input-group">
                    <label for="facebook_link">Facebook Link</label>
                    <input type="url" id="facebook_link" name="facebook_link"><br><br>
                </div>
                <div class="input-group">
                    <label for="instagram_link">Instagram Link</label>
                    <input type="url" id="instagram_link" name="instagram_link"><br><br>
                </div>
                <div class="input-group">
                    <label for="tiktok_link">TikTok Link</label>
                    <input type="url" id="tiktok_link" name="tiktok_link"><br><br>
                </div>
                <div class="input-group">
                    <label for="youtube_link">YouTube Link</label>
                    <input type="url" id="youtube_link" name="youtube_link"><br><br>
                </div>

                <button type="submit">Next</button>
            </form>
        </div>
    </div>

    <script src="public/js/background_slideshow1.js"></script>
    <script src="public/js/signup_validation.js"></script>
    <script src="public/js/get_location.js"></script>
</body>

</html>