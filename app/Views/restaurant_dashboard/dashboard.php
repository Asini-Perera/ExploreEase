<link rel="stylesheet" href="../public/css/restaurant_dashboard/dashboard.css">

<h1>Welcome to the Restaurant Dashboard👋</h1>
<div class="tiles">
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Table Bookings</h2>
                <h1><?php echo $TotalBookings; ?></h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/booking.png" alt="Traveler">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Menu Items</h2>
                <h1><?php echo $TotalMenus; ?></h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/menuicon.jpeg" alt="Menu">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Posts</h2>
                <h1></h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/revenue.jpeg" alt="Traveler">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Packages</h2>
                <h1>$32</h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/revenue2.jpeg" alt="Restaurant">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Average Ratings</h2>
                <h1><?php echo $AverageRatings; ?> ⭐</h1>
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
                <h1><?php echo $TotalReviews; ?></h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/feedback.png" alt="Cultural Event Organizer">
            </div>
        </div>
    </div>
</div>
</body>

</html>