<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cultural Event Organizer Dashboard</title>
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
            } elseif ($mainContent == 'event' && $verifiedAction != 'edit' && $verifiedAction != 'add') {
                require_once __DIR__ . '/event.php';
            } elseif ($mainContent == 'event' && $verifiedAction == 'edit') {
                require_once __DIR__ . '/edit_event.php';
            } elseif ($mainContent == 'event' && $verifiedAction == 'add') {
                require_once __DIR__ . '/add_event.php';
            } elseif ($mainContent == 'post' && $verifiedAction == 'edit') {
                require_once __DIR__ . '/edit_post.php';
            } elseif ($mainContent == 'post' && $verifiedAction == 'add') {
                require_once __DIR__ . '/add_post.php';
            } elseif ($mainContent == 'post' && $verifiedAction != 'edit' && $verifiedAction != 'add') {
                require_once __DIR__ . '/post.php';
            } elseif ($mainContent == 'event' && $verifiedAction == 'delete') {
                require_once __DIR__ . '/delete_event.php';
            } elseif ($mainContent == 'post' && $verifiedAction == 'delete') {
                require_once __DIR__ . '/delete_post.php';
            } else {
                require_once __DIR__ . "/$mainContent.php";
            }
            ?>
        </div>
    </div>
</body>

</html>
</ul>