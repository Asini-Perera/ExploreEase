<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/signupform.css">
</head>
<body>
    <h2>Signup Form</h2>
    <p>provide your details correctly to create an account</p>

    <form action="/traveler/signup" method="post">
    <label for="firstname">First Name:</label><br>
    <input type="text" id="firstname" name="firstname" required><br><br>

    <label for="lastname">Last Name:</label><br>
    <input type="text" id="lastname" name="lastname" required><br><br>

    <label for="email">Email:</label><br>
    <input type="email" id="email" name="email" required><br><br>

    <label for="password">Password:</label><br>
    <input type="password" id="password" name="password" required><br><br>

    <label for="confirm_password">Confirm Password:</label><br>
    <input type="password" id="confirm_password" name="confirm_password" required><br><br>

    <label for="gender">Gender:</label><br>
    <input type="radio" id="male" name="gender" value="male"> Male
    <input type="radio" id="female" name="gender" value="female"> Female<br><br>

    <label for="dob">Date of Birth:</label><br>
    <input type="date" id="dob" name="dob"><br><br>

    <label for="contactNo">Contact Number:</label><br>
    <input type="text" id="contactNo" name="contactNo"><br><br>

    <label for="location">Location:</label><br>
    <input type="text" id="location" name="location"><br><br>

    <label for="smlink">Social Media Link:</label><br>
    <input type="url" id="smlink" name="smlink"><br><br>

    <button type="submit" formaction="../keyword/traveler">Next</button>
</form>

</body>
</html>