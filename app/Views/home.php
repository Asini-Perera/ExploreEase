<!DOCTYPE html>
<html>
<head>
    <title>Home</title>
</head>
<body>
    <h1>Welcome to the Home Page</h1>

    <a href="admin">Admin Dashboard</a>

    <?php
    
    global $conn;

    // Fetch travelers data
    $sql = "SELECT FirstName, Email FROM traveler";
    $result = $conn->query($sql);

    $travelers = [];
    if ($result->num_rows > 0) {
        // Output data of each row
        while($row = $result->fetch_assoc()) {
            $travelers[] = $row;
        }
    } else {
        echo "0 results";
    }

    $conn->close();
    ?>

    <h2>Travelers</h2>
    <ul>
        <?php foreach ($travelers as $traveler): ?>
            <li><?php echo $traveler['FirstName'] . ' - ' . $traveler['Email']; ?></li>
        <?php endforeach; ?>
    </ul>
    <img src="assets/images/virat.jpg" alt="abc1" width="400" height="600">

    <a href="login.php">Login</a>
</body>
</html>
