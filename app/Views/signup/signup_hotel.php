<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Signup</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/signup_form.css">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHabPak9APZk-8qvZs4j_qNkTl_Pk0aF8"></script>
</head>

<body>
    <div class="container">
        <div class="signup-box">
            <h2>Hotel Signup</h2>
            <p>provide your details correctly to create an account</p>

            <?php
            // Display error message if failed to sign up
            if (isset($_SESSION['error'])) {
                echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']); // Clear the error message
            }
            ?>

            <form action="signup/hotel" method="post">
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
                    <label>Pin Hotel Location on Map *</label>
                    <div id="map" style="height: 400px; width: 100%; border: 1px solid #ccc; margin-bottom: 20px;"></div>
                </div>
                <!-- Hidden inputs to store coordinates -->
                <input type="hidden" id="latitude" name="latitude" value="0" required>
                <input type="hidden" id="longitude" name="longitude" value="0" required>

                <div class="input-group">
                    <label for="contactNo">Contact Number</label>
                    <input type="text" id="contactNo" name="contactNo"><br><br>
                </div>
                <div class="input-group">
                    <label for="description">Description</label>
                    <textarea id="description" name="description"></textarea><br><br>
                </div>
                <div class="input-group">
                    <label for="website">Hotel Website</label>
                    <input type="url" id="website" name="website"><br><br>
                </div>
                <div class="input-group">
                    <label for="smlink">Social Media Links</label>
                    <input type="url" id="smlink" name="smlink"><br><br>
                </div>

                <button type="submit">Next</button>
            </form>
        </div>
    </div>

    <script>
        let marker;

        function initMap() {
            const initialLocation = {
                lat: 6.9271,
                lng: 79.8612
            }; // Default center: Colombo

            const map = new google.maps.Map(document.getElementById("map"), {
                center: initialLocation,
                zoom: 8,
            });

            map.addListener("click", (event) => {
                const clickedLocation = event.latLng;

                // If marker exists, just move it
                if (marker) {
                    marker.setPosition(clickedLocation);
                } else {
                    marker = new google.maps.Marker({
                        position: clickedLocation,
                        map: map,
                    });
                }

                // Set lat/lng values in hidden fields
                document.getElementById("latitude").value = clickedLocation.lat();
                document.getElementById("longitude").value = clickedLocation.lng();
            });
        }

        // Initialize map when page loads
        window.onload = initMap;
    </script>


    <script src="public/js/background_slideshow1.js"></script>
    <script src="public/js/signup_validation.js"></script>
</body>

</html>