<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
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
            if ($mainContent === 'verifyuser') {
                require_once  __DIR__ . "/verifyuser_nav.php";
                require_once  __DIR__ . "/$mainContent" . "_" . "$type.php";
            } elseif ($mainContent === 'verifykeyword') {
                require_once __DIR__ . "/verifykeyword_nav.php";
                require_once __DIR__ . "/verifykeyword.php";
            } elseif ($mainContent === 'search') {
                require_once __DIR__ . "/search_nav.php";
                require_once __DIR__ . "/$mainContent" . "_" . "$type.php";
            } elseif ($mainContent === 'profile') {
                if ($profileAction) {
                    require_once __DIR__ . "/$mainContent" . "_" . "$profileAction.php";
                } else {
                    require_once __DIR__ . "/$mainContent.php";
                }
            } else {
                require_once  __DIR__ . "/$mainContent.php";
            }
            ?>
        </div>
    </div>
</body>

</html>
</ul>