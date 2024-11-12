<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="public/css/admin_login.css">
</head>

<body>
    <div class="container">
        <div class="login-box">
            <div class="logo">
                <img src="public/images/logoexplore.png" alt="ExploreEase Logo">
            </div>
            <h2>Admin Login</h2>

            <?php
            // Display error message if login fails
            if (isset($_SESSION['error'])) {
                echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
                unset($_SESSION['error']); // Clear the error message
            }

            // Check if the AdminID is stored in cookies
            $email = isset($_COOKIE['Email']) ? $_COOKIE['Email'] : '';
            ?>

            <form action="admin/login" method="POST">
                <div class="input-group">
                    <label for="email">Email:</label>
                    <input type="text" id="email" name="email" value="<?php echo htmlspecialchars($email); ?>" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="remember-group">
                    <label for="remember">
                        <input type="checkbox" id="remember" name="remember" <?php if ($email) echo 'checked'; ?>>
                        Remember Me
                    </label>
                    <a href="forgot" class="forgot-password">Forget Password?</a>
                </div>
                <button type="submit">Log In</button>
            </form>
            <p>Don't have an account? <a href="admin/create">Create Account</a></p>
        </div>
    </div>
    <script src="public/js/admin_login.js"></script>
</body>

</html>