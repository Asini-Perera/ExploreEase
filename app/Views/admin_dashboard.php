<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="">
</head>
<body>
<?php
    echo "Welcome to the Admin Dashboard, Admin ID: " . $_SESSION['AdminID'];
    echo "<br>";
    echo "Name: " . $_SESSION['Name'];
?>
    
</body>
</html></ul>