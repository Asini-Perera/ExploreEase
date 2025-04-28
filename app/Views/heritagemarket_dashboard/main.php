<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Market Dashboard</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/dashboard_templates/basic.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>

<body>
    <?php include_once __DIR__ . '/../alert.php'; ?>

    <!-- Header -->
    <?php include_once __DIR__ . '/header.php'; ?>

    <div class="container">
        <!-- Sidebar -->
        <?php include_once __DIR__ . '/sidebar.php'; ?>

        <!-- Main Content -->
        <div class="main-content">
            <?php
            if ($mainContent == 'profile') {
                if ($profileAction) {
                    require_once __DIR__ . "/$mainContent" . "_" . "$profileAction.php";
                } else {
                    require_once __DIR__ . "/$mainContent.php";
                }
            } elseif ($mainContent == 'product') {
                if ($verifiedAction) {
                    require_once __DIR__ . "/$mainContent" . "_" . "$verifiedAction.php";
                } else {
                    require_once __DIR__ . "/$mainContent.php";
                }
            } elseif ($mainContent == 'packages') {
                if ($verifiedAction) {
                    require_once __DIR__ . "/$mainContent" . "_" . "$verifiedAction.php";
                } else {
                    require_once __DIR__ . "/$mainContent.php";
                }
            } else {
                require_once __DIR__ . "/$mainContent.php";
            }
            ?>
        </div>
    </div>
</body>

</html>
</ul>