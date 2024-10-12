<?php
// Assuming you have a session started and the user's name stored in the session
$userName = $_SESSION['Name'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Waiting for Admin Verification</title>
</head>
<body>
    <h1><?php echo htmlspecialchars($userName); ?>,Please wait till you are verified by the admin.</h1>
    
</body>
</html>