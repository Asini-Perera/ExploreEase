<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Heritage Market</title>
    <link rel="stylesheet" href="../public/css/service_traveller_side_view/heritagemarket.css">
    <link rel="stylesheet" href="../public/css/heritagemarket/products.css?v=1">
    <link rel="stylesheet" href="../public/css/logedFooter.css?v=1">
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">

    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHabPak9APZk-8qvZs4j_qNkTl_Pk0aF8&callback=initMap"
        async defer>
    </script>
</head>

<body>
    <?php require_once __DIR__ . "/../Navbar.php"; ?>
    <div class="main-container">

        <header>

            <div class="container">
                <h1 class="r-name"><?php echo $heritageMarket['Name']; ?></h1>
                <h3 class="describe"><?php echo $heritageMarket['Tagline']; ?></h3>

            </div>
        </header>

        <!-- nav-bar -->
        <section class="nav-bar">
            <nav>
                <ul class="nav-links">
                    <li><a href="#about">Overview</a></li>
                    <li><a href="#products">Products</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                </ul>
            </nav>
        </section>


        <!-- about -->
        <section class="about-section" id="about">

            <div class="map-gallery">
                <div id="map" class="map"></div>

                <div class="gallery">
                    <div class="gallery-one">
                        <div>
                            <div class="gallery-img">
                                <img src="../public/images/hilton(2).jpg" alt="hotel-image" class="gallery1-image1">
                            </div>

                            <div class="gallery-img">
                                <img src="../public/images/hilton(3).jpg" alt="hotel-image" class="gallery1-image2">
                            </div>
                        </div>

                        <div>
                            <div class="gallery-img">
                                <img src="../public/images/hilton(1).jpg" alt="hotel-image" class="gallery-main">
                            </div>


                        </div>
                        <div>
                            <div class="gallery-img">
                                <img src="../public/images/hilton(4).jpg" alt="hotel-image" class="gallery1-image3">
                            </div>

                            <div class="gallery-img">
                                <img src="../public/images/hilton(5).jpg" alt="hotel-image" class="gallery1-image4">
                            </div>
                        </div>
                    </div>

                    <div class="gallery-two">
                        <div class="gallery-img">
                            <img src="../public/images/hilton(6).jpg" alt="hotel-image" class="gallery2-image1">
                        </div>

                        <div class="gallery-img">
                            <img src="../public/images/hilton(4).jpg" alt="hotel-image" class="gallery2-image2">
                        </div>

                        <div class="gallery-img">
                            <img src="../public/images/hilton (7).jpg" alt="hotel-image" class="gallery2-image3">
                        </div>

                        <div class="gallery-img">
                            <img src="../public/images/hilton (8).jpg" alt="hotel-image" class="gallery2-image4">
                        </div>
                    </div>
                </div>
            </div>

            <div class="about" id="about">
                <div class="about-content">
                    <h3 class="abt-title">Welcome to Our Heritage Market</h3>
                    <p class="description">
                        <?php echo $heritageMarket['Description']; ?>
                    </p>
                </div>
            </div>


        </section>


        <!-- product -->

        <section class="products" id="products">
            <h2 class="page-title">Our Products</h2>
            <div id="product-list" class="product-container">

                <?php if (!empty($Products)) : ?>
                    <?php foreach ($Products as $Product) : ?>
                        <div class="product-card">
                            <img src="<?php echo htmlspecialchars($Product['ImgPath'] ?? 'default_image.png'); ?>" alt="Product Image" class="product-image">
                            <div class="product-details">
                                <h3 class="product-name"><?php echo htmlspecialchars($Product['Name'] ?? 'No name available'); ?></h3>
                                <p class="product-price">$<?php echo htmlspecialchars($Product['Price'] ?? '0.00'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php else : ?>
                    <p>No products available at the moment.</p>
                <?php endif; ?>
                <!-- <div class="product-card">
                    <img src="../public/images/product1.jpg" alt="Product 1" class="product-image">
                    <div class="product-details">
                        <h3 class="product-name">LACQUERED JEWELRY BOX 06″ (FLOWER CARVING)</h3>
                        <p class="product-price">$25.00</p>
                    </div>
                </div> -->
                <!-- <div class="product-card">
                    <img src="../public/images/product2.jpg" alt="Product 2" class="product-image">
                    <div class="product-details">
                        <h3 class="product-name">ELEPHANT LEG SHAPED LACQUERED PEN HOLDER (MAT)</h3>
                        <p class="product-price">$45.00</p>
                    </div>
                </div> -->
                <!-- <div class="product-card">
                    <img src="../public/images/product3.jpg" alt="Product 3" class="product-image">
                    <div class="product-details">
                        <h3 class="product-name">LAQUARED BOWL WITH LID</h3>
                        <p class="product-price">$30.00</p>
                    </div>
                </div> -->

                <!-- <div class="product-card">
                    <img src="../public/images/ceramicc1.jpg" alt="Product 3" class="product-image">
                    <div class="product-details">
                        <h3 class="product-name">HAND MADE ELEPHANT DESIGN MUG</h3>
                        <p class="product-price">$30.00</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="../public/images/ceramicc2.jpg" alt="Product 3" class="product-image">
                    <div class="product-details">
                        <h3 class="product-name">HAND PAINTED CLAY PLATE</h3>
                        <p class="product-price">$30.00</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="../public/images/ceramicc6.jpg" alt="Product 3" class="product-image">
                    <div class="product-details">
                        <h3 class="product-name">HAND MADE CERAMIC ORNAMENT</h3>
                        <p class="product-price">$30.00</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="../public/images/rushc2.jpg" alt="Product 3" class="product-image">
                    <div class="product-details">
                        <h3 class="product-name">CANE LAMP SHADE WITH WOODEN STAND</h3>
                        <p class="product-price">$30.00</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="../public/images/rushc8.jpg" alt="Product 3" class="product-image">
                    <div class="product-details">
                        <h3 class="product-name">BANANA FIBER CLUTCH BAG</h3>
                        <p class="product-price">$30.00</p>
                    </div>
                </div>
                <div class="product-card">
                    <img src="../public/images/rushc9.jpg" alt="Product 3" class="product-image">
                    <div class="product-details">
                        <h3 class="product-name">INDIKOLA SEWING ROUND BOX WITH LID</h3>
                        <p class="product-price">$30.00</p>
                    </div>
                </div> -->
            </div>
        </section>




        <!-- reviews -->
        <section class="reviews" id="reviews">
            <div class="review-heading">
                <h2>What Our Customers Say</h2>
                <p>See what our guests have to say about their experience</p>
            </div>

            <div class="review-container" style="display: flex; overflow: hidden; width: 100%;">
                <div class="review-wrapper" style="display: flex; transition: transform 0.5s ease-in-out; width: 100%;">
                    <?php foreach ($Reviews as $Review) : ?>
                        <div class="review-slide" style="flex: 0 0 25%; box-sizing: border-box;">
                            <div class="review">
                                <div class="customer-info">
                                    <div class="customer-pic">
                                        <a href="#"><img src="<?php echo htmlspecialchars($Review['ImgPath'] ?? 'default_image.png'); ?>"></a>
                                    </div>
                                    <div class="customer-details">
                                        <h5><?php echo htmlspecialchars($Review['FirstName'] . ' ' . $Review['LastName']); ?></h5>
                                        <?php
                                        $rating = (int)$Review['Rating']; // Assuming 'Rating' is a number between 0 and 5
                                        $stars = str_repeat('&#9733;', $rating) . str_repeat('&#9734;', 5 - $rating); // Filled and empty stars
                                        ?>
                                        <span class="rating"><?php echo $stars; ?></span> <!-- Star Rating -->
                                    </div>
                                </div>

                                <p class="review-msg"><?php echo htmlspecialchars($Review['Comment'] ?? 'No comment available'); ?></p>
                            </div>

                            <div class="response">
                                <p><?php echo htmlspecialchars($Review['Response'] ?? 'No response available'); ?></p>
                            </div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>

            <div class="carousel-controls">
                <button class="prev" onclick="moveCarousel(-1)">&#10094;</button>
                <button class="next" onclick="moveCarousel(1)">&#10095;</button>
            </div>

            <script>
                let currentIndex = 0;
                const reviewsToShow = 4;
                const reviewWrapper = document.querySelector('.review-wrapper');
                const totalReviews = <?php echo count($Reviews); ?>;

                function moveCarousel(direction) {
                    const slideWidth = reviewWrapper.querySelector('.review-slide').offsetWidth;
                    const totalSlides = totalReviews;
                    const maxIndex = totalSlides - reviewsToShow; // important
                    currentIndex += direction;

                    if (currentIndex < 0) {
                        currentIndex = maxIndex;
                    } else if (currentIndex > maxIndex) {
                        currentIndex = 0;
                    }

                    const offset = -currentIndex * slideWidth;
                    reviewWrapper.style.transform = `translateX(${offset}px)`;
                }


                function autoSlide() {
                    moveCarousel(1);
                }

                setInterval(autoSlide, 5000); // Auto slide every 5 seconds
            </script>
        </section>


        <!-- contact us  -->
        <section class="contact_us">
            <div class="contact-heading">
                <h2>Contact Us</h2>
                <p>We’d love to hear from you! Get in touch through any of the following ways:</p>
            </div>

            <div class="contact">
                <div class="contact-info">
                    <img class="contact_img" alt="Location" src="../public/images/location.png">
                    <h3>Address</h3>
                    <p><?php echo $heritageMarket['Address']; ?></p>
                </div>

                <div class="contact-info">
                    <img class="contact_img" alt="Opening Hours" src="../public/images/open.png">
                    <h3>Opening Hours</h3>
                    <p>Weekdays: <?php echo $heritageMarket['WeekdayOpenHours']; ?></p>
                    <p>Weekends: <?php echo $heritageMarket['WeekendOpenHours']; ?></p>
                </div>

                <div class="contact-info">
                    <img class="contact_img" alt="Email" src="../public/images/email.png">
                    <h3>Email</h3>
                    <p><?php echo $heritageMarket['Email']; ?></p>
                </div>

                <div class="contact-info">
                    <img class="contact_img" alt="Phone" src="../public/images/phone-call.png">
                    <h3>Phone</h3>
                    <p><?php echo $heritageMarket['ContactNo']; ?></p>
                </div>
            </div>

            <div class="share">
                <?php if (!empty($heritageMarket['TikTokLink'])) : ?>
                    <a href="<?php echo $heritageMarket['TikTokLink']; ?>" class="social-link"><img alt="Tiktok" src="../public/images/tiktok.webp"></a>
                <?php endif; ?>
                <?php if (!empty($heritageMarket['FacebookLink'])) : ?>
                    <a href="<?php echo $heritageMarket['FacebookLink']; ?>" class="social-link"><img alt="Facebook" src="../public/images/facebook.png"></a>
                <?php endif; ?>
                <?php if (!empty($heritageMarket['InstagramLink'])) : ?>
                    <a href="<?php echo $heritageMarket['InstagramLink']; ?>" class="social-link"><img alt="Instagram" src="../public/images/instagram.png"></a>
                <?php endif; ?>
                <?php if (!empty($heritageMarket['YoutubeLink'])) : ?>
                    <a href="<?php echo $heritageMarket['YoutubeLink']; ?>" class="social-link"><img alt="YouTube" src="../public/images/youtube.png"></a>
                <?php endif; ?>
            </div>
        </section>
    </div>
    <div class="review-button-container1">
        <a href="http://localhost/ExploreEase/review?type=<?= urlencode($type) ?>&id=<?= urlencode($id) ?>" class="review-button1">Add a Review</a>

    </div>
    <?php require_once __DIR__ . "/../logedFooter.php"; ?>
    <script src="../public/js/restaurant.js"></script>

    <script>
        function initMap() {
            // Pull the PHP vars into JS
            const lat = parseFloat("<?= $heritageMarket['Latitude']; ?>");
            const lng = parseFloat("<?= $heritageMarket['Longitude']; ?>");

            // Create the map
            const map = new google.maps.Map(document.getElementById('map'), {
                center: {
                    lat,
                    lng
                },
                zoom: 12
            });

            // Place a marker on the hotel
            new google.maps.Marker({
                position: {
                    lat,
                    lng
                },
                map: map,
                title: "<?= htmlspecialchars($heritageMarket['Name'], ENT_QUOTES); ?>",
                label: {
                    text: "<?= htmlspecialchars($heritageMarket['Name'], ENT_QUOTES); ?>",
                    color: "white",
                    fontSize: "12px",
                    fontWeight: "bold"
                }
            });
        }
    </script>
</body>

</html>