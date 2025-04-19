<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hotel Dashboard</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/dashboard_templates/basic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <!-- Header -->
    <?php include_once __DIR__ . '/header.php'; ?>

    <div class="container">
        <!-- Sidebar -->
        <?php include_once __DIR__ . '/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <?php
            if ($mainContent == 'profile' && $action == 'edit') {
                require_once __DIR__ . '/edit_profile.php';
            } elseif ($mainContent == 'profile' && $action == 'change-password') {
                require_once __DIR__ . '/profile_changepassword.php';
            } elseif ($mainContent == 'room' && $verifiedAction != null) {
                require_once __DIR__ . "/$verifiedAction" . "_room.php";
            } elseif ($mainContent == 'post' && $verifiedAction != null) {
                require_once __DIR__ . "/$verifiedAction" . "_post.php";
            } else {
                require_once __DIR__ . "/$mainContent.php";
            }
            ?>
        </div>
    </div>
</body>

</html>
</ul>