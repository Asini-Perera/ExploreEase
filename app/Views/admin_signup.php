<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/signup_form.css">
</head>

<body>
    <div class="container">
        <div class="signup-box">
            <h2>Admin Signup</h2>
            <p>provide your details correctly to create an account</p>

            <?php
            // Display error message if failed to sign up
            if (isset($_SESSION['error'])) {
                echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']); // Clear the error message
            }
            ?>

            <form action="../admin/signup" method="post" enctype="multipart/form-data">
                <div class="input-group">
                    <label for="firstname">First Name *</label>
                    <input type="text" id="firstname" name="firstname" required><br><br>
                </div>
                <div class="input-group">
                    <label for="lastname">Last Name *</label>
                    <input type="text" id="lastname" name="lastname" required><br><br>
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
                    <input type="tel" id="contactNo" name="contactNo"><br><br>
                </div>
                <div class="input-group">
                    <label for="profile_image">Profile Image</label>
                    <input type="file" id="profile_image" name="profile_image" accept="image/*"><br><br>
                </div>
                <button type="submit">Submit</button>
            </form>
        </div>
    </div>
    <script src="../public/js/signup_validation.js"></script>
    <script src="../public/js/background_slideshow2.js"></script>
</body>

</html>