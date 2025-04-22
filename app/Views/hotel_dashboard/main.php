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
            } elseif ($mainContent == 'room' && $verifiedAction == 'edit') {
                require_once __DIR__ . '/edit_room.php';
            } elseif ($mainContent == 'room' && $verifiedAction == 'add') {
                require_once __DIR__ . '/add_room.php';
            } elseif ($mainContent == 'post' && $verifiedAction == 'edit') {
                require_once __DIR__ . '/edit_post.php';
            } elseif ($mainContent == 'post' && $verifiedAction == 'add') {
                require_once __DIR__ . '/add_post.php';          
            } elseif ($mainContent == 'bookings' && $verifiedAction == 'edit') {
                require_once __DIR__ . '/edit_booking.php';
            } elseif ($mainContent == 'reviews' && $verifiedAction == 'reply') {
                require_once __DIR__ . '/reply_review.php';            
            } else {
                // Check if the requested file exists
                $file_path = __DIR__ . "/$mainContent.php";
                if (file_exists($file_path)) {
                    require_once $file_path;
                } else {
                    // If file doesn't exist, show 404 page
                    require_once __DIR__ . "/404.php";
                }
            }
            ?>
        </div>
    </div>
</body>

</html>
</ul>