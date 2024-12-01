<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Market</title>
    <link rel="stylesheet" href="../public/css/heritagemarket/shops.css?v=1">

</head>
<body>
    <?php require_once __DIR__ . '/../Navbar.php'; ?>

    
<div class="cover-container">
    <h1 class="cover-title">Heritage Market Shops</h1>
    <img src="../public/images/heritagebackground.png" alt="cover" class="cover-image">
</div>


    <!-- Shops List Section -->
    <section class="shops-container">
      
        <div class="shops-list">
            <div class="shop-card">
                <img src="../public/images/pottery.jpg" alt="Shop 1" class="shop-image">
                <h2 class="shop-title">Antique Treasures</h2>
                <p class="shop-description">Discover rare and unique antiques from the past.</p>
                <p class="shop-address">
    <a href="https://www.google.com/maps?q=123+Heritage+Lane,+Cityville" target="_blank" class="location-link">
        <span class="location-icon">
            <img src="../public/images/location.png" alt="Location Icon">
        </span>
        123 Heritage Lane, Cityville
    </a>
</p>

                <a href="http://localhost/ExploreEase/heritageMarket/products" class="shop-link">Click here to view the products →</a>
        </div>

            <div class="shop-card">
                <img src="../public/images/artGallery.jpg" alt="Shop 2" class="shop-image">
                <h2 class="shop-title">Craft Creations</h2>
                <p class="shop-description">Handcrafted goods made with love and care.</p>
            </div>
            <div class="shop-card">
                <img src="../public/images/rush.webp" alt="Shop 3" class="shop-image">
                <h2 class="shop-title">Vintage Vibes</h2>
                <p class="shop-description">Authentic vintage apparel and accessories.</p>
            </div>
            <div class="shop-card">
                <img src="../public/images/handcraft.jpg" alt="Shop 3" class="shop-image">
                <h2 class="shop-title">Vintage Vibes</h2>
                <p class="shop-description">Authentic vintage apparel and accessories.</p>
            </div>
            <div class="shop-card">
                <img src="../public/images/gallecraft.jpg" alt="Shop 3" class="shop-image">
                <h2 class="shop-title">Vintage Vibes</h2>
                <p class="shop-description">Authentic vintage apparel and accessories.</p>
            </div>
            <div class="shop-card">
                <img src="../public/images/pottery1.jpg" alt="Shop 3" class="shop-image">
                <h2 class="shop-title">Vintage Vibes</h2>
                <p class="shop-description">Authentic vintage apparel and accessories.</p>
            </div>
            <!-- Add more shop cards as needed -->
        </div>
    </section>
</body>
</html>
