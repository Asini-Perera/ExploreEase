<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Dashboard</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/dashboard_templates/basic.css">
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
            if ($mainContent === 'dashboard') {
                require_once  __DIR__ . "/dashboard.php";
            } elseif ($mainContent === 'profile') {
                require_once  __DIR__ . "/profile.php";
            } elseif ($mainContent === 'menulist') {
                require_once  __DIR__ . "/menu_list.php";
            } elseif ($mainContent === 'bookings') {
                require_once  __DIR__ . "/bookings.php";
            } elseif ($mainContent === 'reviews') {
                require_once  __DIR__ . "/reviews.php";
            } else {
                require_once  __DIR__ . "/$mainContent.php";
            }
            ?>
        </div>
</body>

</html>
</ul>