<!DOCTYPE html>
<html>

<head>
    <title>Home</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
</head>

<body>
    <h1>Welcome to the Home Page</h1>

    <?php

    global $conn;

    // Fetch travelers data
    $sql = "SELECT FirstName, Email FROM traveler";
    $result = $conn->query($sql);

    $travelers = [];
    if ($result->num_rows > 0) {
        // Output data of each row
        while ($row = $result->fetch_assoc()) {
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

    <a href="login">Login</a>

    <p>Don't have an account?</p>
    <a href="signup">Signup</a>
</body>

</html>