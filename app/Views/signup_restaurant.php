<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/signupform.css">
</head>
<body>
    <h2>Signup Form</h2>
    <p>provide your details correctly to create an account</p>

    <form action="restaurant_signupform.php" method="post">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="location">Location:</label><br>
        <input type="text" id="location" name="location" required><br><br>

        <label for="contactNo">Contact Number:</label><br>
        <input type="text" id="contactNo" name="contactNo"><br><br>
        
        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="website">Website:</label><br>
        <input type="url" id="website" name="website" value=""><br><br>
        
        <label for="password">Password:</label><br>
        <input type="password" id="password" name="password" required><br><br>
        
        <label for="confirm_password">Confirm Password:</label><br>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <label for="open_hours">Open Hours:</label><br>
        <input type="text" id="open_hours" name="openhours" value=""><br><br>
        
        <label for="cuisine_types">Cuisine Type:</label><br>
        <input type="text" id="cuisine_types" name="cuisinetype" value=""><br><br>

        <button type="submit" formaction="../keyword/serviceprovider">Next</button>
    </form>
</body>
</html>