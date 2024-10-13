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
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/admin_waiting.css">
</head>
<body>
    <div class="container">
        <div class="verification-box">
            <!-- Logo Section -->
            <div class="logo">
                <img src="../public/images/logoexplore.png" alt="ExploreEase Logo">
            </div>

            <h1>Welcome to ExploreEase, <?php echo htmlspecialchars($userName); ?>!</h1>
            <p>Your account has been successfully created, but it needs to be verified by an admin.</p>
            <p>This process can take up to <strong>2-3 business days</strong>. Please be patient, and you'll receive an email notification once your account is verified.</p>
            <p>If you have any urgent concerns, feel free to contact us at <a href="mailto:support@yourwebsite.com">support@yourwebsite.com</a>.</p>
            
            <!-- Logout Button -->
            <form action="../admin/logout" method="POST">
                <button type="submit">Log Out</button>
            </form>
        </div>
    </div>
</body>
</html>
