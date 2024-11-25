<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <!-- <link rel="stylesheet" type="text/css" href="../public/css/restaurant_dashboard/admin.css"> -->
</head>
<body>

    <!-- header -->
     <?php include_once __DIR__ . '/header.php'; ?>

    <div class="container">
        <!-- side bar -->
        <?php include_once __DIR__ . '/side_bar.php'; ?>

        <!-- main content -->
        <div class="main-content">
            <?php require_once __DIR__ . "/$mainContent.php"; ?>
        </div>
    </div>
    
</body>
</html>