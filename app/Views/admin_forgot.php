<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Forgot Password</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/forgot_password.css">
</head>

<body>
    <h2>Forgot Password</h2>
    <p>Enter your email to reset your password</p>

    <?php
    // Display error message if email is not found
    if (isset($_SESSION['error'])) {
        echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
        unset($_SESSION['error']); // Clear the error message
    }

    // Display success message if email is sent
    if (isset($_SESSION['success'])) {
        echo '<div class="success">' . htmlspecialchars($_SESSION['success']) . '</div>';
        unset($_SESSION['success']); // Clear the success message
    }
    ?>

    <form action="../admin/request" method="POST">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <button type="submit">Submit</button>
    </form>
</body>

</html>