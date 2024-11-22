<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/admin_dashboard/admin_main.css">
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
            if ($mainContent === 'verify') {
                require_once  __DIR__ . "/verify_nav.php";
                require_once  __DIR__ . "/$mainContent" . "_" . "$verifyUser.php";
            } elseif ($mainContent === 'keyword') {
                require_once  __DIR__ . "/keyword_nav.php";
                require_once  __DIR__ . "/$mainContent" . "_" . "$keywordAction.php";
            } else {
                require_once  __DIR__ . "/$mainContent.php";
            }
            ?>
        </div>
    </div>
</body>

</html>
</ul>