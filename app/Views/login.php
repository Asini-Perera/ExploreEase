<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Log in</title>
    <link rel="stylesheet" href="assets/css/login.css">   
</head>
<body>
    <div class="side left">
        <img src="assets/images/logo.jpeg" alt="logo">
    </div>

    <div class="side right">
        <div class="content">
            <p class="title">ExploreEase</p>
            <label for="name" class="username">Username:</label>
            <input type="text" id="username" placeholder="Enter the username" name="name" required>

            <label for="psswd" class="username">Password:</label>
            <input type="password" id="password" placeholder="Enter the password" name="psswd" required>

            
            <div class="forgot">
                <label>
                    <input type="checkbox" checked="checked" name="remember"> Remember me
                </label>
                <a href="">Forgot Password?</a>
            </div>

            <button class="login">Log in</button>

            <hr color="white" width="100%">

            <div class="signup">
                <p>Don't have an account?</p>
                <a href="../public/signup">Sign up</a>
            </div>

        </div>
    </div>
    </div>
</body>
</html>


