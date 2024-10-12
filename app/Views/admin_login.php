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
    <div class="login-container">
        <div class="login-box">
            <h2>Admin Login</h2>
            <p>Please enter your AdminID and password to continue</p>
            
            <?php
                $AdminID = isset($_COOKIE['AdminID']) ? $_COOKIE['AdminID'] : '';
                $password = isset($_COOKIE['Password']) ? $_COOKIE['Password'] : '';
            ?>

            <form action="admin/login" method="POST">
                <div class="input-group">
                    <label for="AdminID">AdminID:</label>
                    <input type="text" id="AdminID" name="AdminID" value="<?php echo htmlspecialchars($AdminID); ?>" required>
                </div>
                <div class="input-group">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
                <div class="remember-group">
                    <label for="remember">
                        <input type="checkbox" id="remember" name="remember" <?php if($AdminID) echo 'checked'; ?>> Remember Me
                    </label>
                    <a href="#" class="forgot-password">Forget Password?</a>
                </div>
                <button type="submit">Log In</button>
            </form>
            <p>Don't have an account? <a href="admin/signup">Create Account</a></p>
        </div>
    </div>
</body>
</html>
