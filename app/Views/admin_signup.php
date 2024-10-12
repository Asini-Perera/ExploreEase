<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Signup</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/admin_signup.css">
</head>
<body>
    <h2>Admin Signup Form</h2>
    <p>provide your details correctly to create an account</p>

    <form action="" method="post">
        <label for="firstname">First Name:</label>
        <input type="text" id="firstname" name="firstname" required><br><br>

        <label for="lastname">Last Name:</label>
        <input type="text" id="lastname" name="lastname" required><br><br>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br><br>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <label for="contactNo">Contact Number:</label>
        <input type="tel" id="contactNo" name="contactNo"><br><br>

        <label for="profile_image">Profile Image:</label>
        <input type="file" id="profile_image" name="profile_image" accept="image/*"><br><br>

        <button type="submit" formaction="">Submit</button>
    </form>
</body>
</html>