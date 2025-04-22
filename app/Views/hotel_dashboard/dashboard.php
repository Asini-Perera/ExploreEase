<link rel="stylesheet" href="../public/css/hotel_dashboard/dashboard.css">

    <h1>Welcome to the Service Provider Dashboard👋</h1>
    <div class="tiles">
        <div class="tile">
            <div class="tile-content">
                <div class="tile-text">
                    <h2>Room Bookings</h2>
                    <h1><?php echo $TotalBookings; ?></h1>
                </div>
                <div class="tile-image">
                    <img src="../public/images/room.jpeg" alt="Traveler">  
                </div>
            </div>
        </div>
        
        <div class="tile">
            <div class="tile-content">
                <div class="tile-text">
                    <h2>Total Rooms</h2>
                    <h1><?php echo $TotalRooms; ?></h1>
                </div>
                <div class="tile-image">
                    <img src="../public/images/rooms.jpeg" alt="Menu">
                </div>
            </div>
        </div>

        <div class="tile">
            <div class="tile-content">
                <div class="tile-text">
                    <h2>Total Revenue</h2>
                    <h1>$<?php echo $TotalRevenue; ?></h1>
                </div>
                <div class="tile-image">
                    <img src="../public/images/revenue.jpeg" alt="Traveler">
                </div>
            </div>
        </div>

        <div class="tile">
            <div class="tile-content">
                <div class="tile-text">
                    <h2>Revenue in last Week</h2>
                    <h1>$<?php echo $TotalRevenueInLastWeek; ?></h1>
                </div>
                <div class="tile-image">
                    <img src="../public/images/revenue2.jpeg" alt="Restaurant">
                </div>
            </div>
        </div>
        <div class="tile">
            <div class="tile-content">
                <div class="tile-text">
                    <h2>Total Ratings</h2>
                    <h1><?php echo $TotalRatings; ?></h1>
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
                    <h1><?php echo $TotalFeedbacks; ?></h1>
                </div>
                <div class="tile-image">
                    <img src="../public/images/feedback.png" alt="Cultural Event Organizer">
                </div>
            </div>
        </div>
    </div>
</body>
</html>