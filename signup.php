<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign up</title>
    <link rel="stylesheet" href="signup.css">
</head>
<body>
    <div class="side left">
        <div class="container">
            <h2 class="title">Are you a traveler?</h2>
            <p class="content">Join us and explore the world with us.</p>
            <button>Sign up</button>
        </div>
        <img src="traveler.svg" alt="traveler img">

    </div>
    <div class="side right">
        <div class="container">
            <h2 class="title">Join with us as a service provider!</h2>
            <p class="content">We are here to help you reach out to the world.</p>
            <label for="serviceprovider">Choose your service type:</label>
            <select name="serviceprovider" id="serviceprovider">
                <option value="hotel">Hotel</option>
                <option value="restaurant">Restaurant</option>
                <option value="heritagemarket">Heritage Market</option>
                <option value="culturaleventorg">Cultural Event Organizer</option>
            </select><br>

            <button>Sign up</button>
        </div>
    <img src="serviceprovider.svg" alt="service provider img">
    </div>
</body>
</html>