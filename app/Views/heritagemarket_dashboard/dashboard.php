<link rel="stylesheet" href="../public/css/heritagemarket_dashboard/dashboard.css">

<h1>Welcome to the Heritage Market Dashboard👋</h1>
<div class="tiles">
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Products</h2>
                <h1><?php echo $totalProducts; ?></h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/product.jpg" alt="Menu">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Feedbacks with 5.0</h2>
                <h1><?php echo $feedbacksWith5; ?></h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/5stars.png" alt="Traveler">
            </div>
        </div>
    </div>

    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Average Ratings</h2>
                <h1><?php echo $averageRatings; ?></h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/ratings.jpeg" alt="Heritage Market">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Feedbacks</h2>
                <h1><?php echo $totalReviews; ?></h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/feedback.png" alt="Cultural Event Organizer">
            </div>
        </div>
    </div>
</div>
</body>

</html>