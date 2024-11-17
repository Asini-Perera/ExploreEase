<h1>Welcome to the Admin Dashboard</h1>
<div class="tiles">
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Travelers</h2>
                <h1>1500</h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/traveler1.png" alt="Traveler">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>New Travelers in this month</h2>
                <h1>200</h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/traveler2.webp" alt="Traveler">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Restaurants</h2>
                <h1>300</h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/restaurant.webp" alt="Restaurant">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Hotels</h2>
                <h1>120</h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/hotel.jpg" alt="Hotel">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Heritage Markets</h2>
                <h1>50</h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/heritagemarket.webp" alt="Heritage Market">
            </div>
        </div>
    </div>
    <div class="tile">
        <div class="tile-content">
            <div class="tile-text">
                <h2>Total Cultural Event Organizers</h2>
                <h1>75</h1>
            </div>
            <div class="tile-image">
                <img src="../public/images/culturaleventorganizer.jpg" alt="Cultural Event Organizer">
            </div>
        </div>
    </div>
</div>

<style>
    .tiles {
        display: flex;
        flex-wrap: wrap;
        padding: 30px;
        padding-top: 0px;
        gap: 30px; /* Space between tiles */
    }

    .tile {
        flex: 1 1 calc(33.33% - 30px); /* 3 tiles per row */
        box-sizing: border-box;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 8px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        height: 250px; /* Increase height */
    }

    .tile-content {
        display: flex;
        justify-content: space-between;
        align-items: center;
        height: 100%;
    }

    .tile-text {
        text-align: center;
        flex: 1;
    }

    .tile-text h2 {
        font-size: 18px;
        margin-bottom: 10px;
        color: #333;
    }

    .tile-text h1 {
        font-size: 36px;
        color: #555;
        margin: 0;
    }

    .tile-image {
        flex-shrink: 0;
    }

    .tile-image img {
        width: 100px;
        height: 100px;
    }

    h1 {
        font-family: Arial, sans-serif;
        padding: 10px;
        color: #333;
    }
</style>
