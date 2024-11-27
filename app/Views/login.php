<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/login.css">
</head>

<body>
    <div class="side left">
        <a href="../ExploreEase"><img src="public/images/logo.jpeg" alt="logo"></a>
    </div>

    <div class="side right">
        <div class="content">
            <p class="title">ExploreEase</p>

            <?php
            // Display error message if login fails
            if (isset($_SESSION['error'])) {
                echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']); // Clear the error message
            }

            // Display success message if password reset successful
            if (isset($_SESSION['success'])) {
                echo '<div class="success">' . htmlspecialchars($_SESSION['success']) . '</div>';
                unset($_SESSION['success']); // Clear the success message
            }

            // Check if Email is stored in cookies
            $email = isset($_COOKIE['Email']) ? $_COOKIE['Email'] : '';
            ?>

            <form action="login/process" method="POST">
                <label for="name" class="username">Email:</label>
                <input type="text" id="email" placeholder="Enter the email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>

                <label for="psswd" class="username">Password:</label>
                <input type="password" id="password" placeholder="Enter the password" name="psswd" required>

                <div class="forgot">
                    <label>
                        <input type="checkbox" checked="checked" name="remember" <?php if ($email) echo 'checked'; ?>> Remember me
                    </label>
                    <a href="">Forgot Password?</a>
                </div>

                <button type="submit" class="login">Log in</button>
            </form>
            <hr color="white" width="100%">

            <div class="signup">
                <p>Don't have an account?</p>
                <a href="signup">Sign up</a>
            </div>
        </div>
    </div>
    </div>
</body>

</html>