<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login</title>
    <link rel="stylesheet" href="public/css/admin_login.css">
</head>
<body>
    <div class="login-container">
        <div class="login-box">
            <h2>Admin Login</h2>
            <p>Please enter your username and password to continue</p>
            <form action="" method="POST">
                <div class="input-group">
                    <label for="username">Username:</label>
                    <input type="username" id="username" name="username" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="remember-group">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">Remember Me</label>
                    <a href="#" class="forgot-password">Forget Password?</a>
                </div>
                <button type="submit" class="login-btn">Log In</button>
            </form>
            <p>Don't have an account? <a href="#">Create Account</a></p>
        </div>
    </div>
</body>
</html>
