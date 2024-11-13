<?php
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Provider Dashboard</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <style>
        body {
            display: flex;
            margin: 0;
            padding: 0;
            height: 100vh;
            overflow: hidden;
        }

        .container {
            flex-grow: 1;
            padding: 20px;
            overflow-y: auto;
        }

        .navbar {
            background-color: #225522;
            padding: 10px;
            position: fixed;
            top: 0;
            left: 0;
            height: 100%;
            width: 250px;
            display: flex;
            flex-direction: column;
            align-items: flex-start;
        }

        .navbar .content h1 {
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }

        .navbar .content p {
            color: #ffffff;
            margin: 0;
            padding: 20px;
        }

        .navbar-nav {
            display: flex;
            flex-direction: column;
            width: 100%;
        }

        .navbar-nav .nav-item {
            width: 100%;
        }

        .navbar-nav .nav-item .nav-link {
            color: #F1C232;
            margin-left: 0;
            padding: 10px 20px;
            width: 100%;
        }

        .navbar-nav .nav-item .nav-link:hover {
            color: #cccccc;
        }

        .card {
            margin: 10px;
            border: 1px solid #ddd;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            width: 100%;
            height: 200px;
            cursor: pointer;
            background-color: #f3bd1c;
        }

        .card:hover {
            transform: translateX(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .card-title {
            font-size: 1.25rem;
            font-weight: bold;
        }

        .card-text {
            font-size: 1rem;
            color: #555;
        }
        .card-body {
            position: relative;
        }

        .card-body .btn {
            position: absolute;
            bottom: 10px;
            right: 10px;
            border: none;
            background-color: transparent;
            color: #ffffff;
        }
        .container {
            background-image: url('C:/xampp/htdocs/ExploreEase/public/images/map.svg');
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            height: 100vh;
            width: 100vw;
        }
 
    </style>
</head>
<body>
    <nav class="navbar navbar-dark">
        <div class="content">
            <h1>Service Provider Dashboard</h1>
            <p>Welcome to the Dashboard</p>
        </div>   
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link" href="#">Profile</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Settings</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Logout</a>
                </li>

            </ul>
    </nav>
    <div class="container" style="margin-left: 250px; padding: 20px;">
        
        <div class="row">
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Photos/Videos</h5>
                        <p class="card-text">Manage your photos & videos here.</p>
                        <a href="#" class="btn btn-primary">See More></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Bookings/Orders</h5>
                        <p class="card-text">View and manage your bookings & orders here.</p>
                        <a href="#" class="btn btn-primary">See More></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Ratings</h5>
                        <p class="card-text">Check your ratings & reviews here.</p>
                        <a href="#" class="btn btn-primary">See More></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Feedbacks</h5>
                        <p class="card-text">View and respond to customer feedbacks here.</p>
                        <a href="#" class="btn btn-primary">See More></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title">Transactions</h5>
                        <p class="card-text">View and manage your transactions here.</p>
                        <a href="#" class="btn btn-primary">See More></a>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>