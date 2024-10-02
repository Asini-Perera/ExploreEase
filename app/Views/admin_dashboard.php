<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
</head>
<body>
    <h1>Welcome to the Admin Dashboard</h1>

    <p>Here you can manage users, posts, and other resources.</p>

    <a href="../ExploreEase">Home</a>

    <?php
    require_once __DIR__ . '/../models/UserModel.php';
    
    use app\models\UserModel;

    global $conn;
    
    $userModel = new UserModel($conn);

    $user = $userModel->getUserById("T000001");

    echo $user['FirstName'] . ' - ' . $user['Email'];

    ?>
    
</body>
</html>
