<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>hotel</title>
    <link rel="stylesheet" href="../public/css/service_traveller_side_view/hotel.css">
    <link rel="stylesheet" href="../public/css/logedFooter.css?v=1">
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
                <h1 class="h-name"><?php echo $hotel['Name']; ?></h1>
                <h3 class="describe"><?php echo $hotel['Tagline']; ?></h3>
            </div>
        </header>

        <!-- nav-bar -->
        <section class="nav-bar">
            <nav>
                <ul class="nav-links">
                    <li><a href="#about">Overview</a></li>
                    <li><a href="#facilities">Facilities</a></li>
                    <li><a href="#info">Info</a></li>
                    <li><a href="#bookings">Bookings</a></li>
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

            <div class="about">
                <div class="content">
                    <h3 class="abt-title" style="text-align: center;">Welcome to our Hotel</h3>
                    <p class="description"><?php echo $hotel['Description']; ?></p>
                </div>
            </div>
        </section>


        <!-- Facilities Section -->
        <section class="facilities" id="facilities">
            <div class="facilities-content">
                <div class="facility">
                    <img src="../public/images/swimpool.jpg" alt="Swimming Pool" class="facility-image">
                    <h3>Swimming Pool</h3>
                    <p>Enjoy a refreshing swim in our outdoor pool.</p>
                </div>

                <div class="facility">
                    <img src="../public/images/gym.jpg" alt="Gym" class="facility-image">
                    <h3>Fitness Center</h3>
                    <p>Stay fit and healthy with our state-of-the-art gym facilities.</p>
                </div>

                <div class="facility">
                    <img src="../public/images/spa.jpg" alt="Spa" class="facility-image">
                    <h3>Spa</h3>
                    <p>Relax and rejuvenate with our luxurious spa treatments.</p>
                </div>

                <div class="facility">
                    <img src="../public/images/restaurant-image (2).jpg" alt="Restaurant" class="facility-image">
                    <h3>Restaurant</h3>
                    <p>Indulge in gourmet dining at our on-site restaurant.</p>
                </div>

                <div class="facility">
                    <img src="../public/images/conference.jpg" alt="Conference Room" class="facility-image">
                    <h3>Conference Room</h3>
                    <p>Host your meetings and events in our well-equipped conference room.</p>
                </div>

                <div class="facility">
                    <img src="../public/images/bar.jpg" alt="Bar" class="facility-image">
                    <h3>Bar</h3>
                    <p>Unwind with a drink at our stylish bar.</p>
                </div>
            </div>
        </section>


        <!-- Info Section -->
        <section class="info" id="info">
            <div class="info-content">
                <!-- Check-in, Check-out, Special Instructions, and Other Info -->
                <div class="info-one">
                    <div class="check-in-out">
                        <!-- Check-in Section -->
                        <div class="check-in">
                            <div class="top">
                                <img src="../public/images/check-in.png" alt="check-in">
                                <h3>Check-in</h3>
                            </div>
                            <p>Check-in start time: 2:00 PM; Check-in end time: anytime</p>
                            <p>Express check-in available</p>
                            <p>Minimum check-in age: 18</p>
                        </div>
                        <!-- Check-out Section -->
                        <div class="check-out">
                            <div class="top">
                                <img src="../public/images/check-out.png" alt="check-out">
                                <h3>Check-out</h3>
                            </div>
                            <p>Check-out before noon</p>
                            <p>Late check-out subject to availability</p>
                            <p>A late check-out fee will be charged</p>
                            <p>Express check-out available</p>
                        </div>
                        <!-- Special Instructions Section -->
                        <div class="special-instructions">
                            <div class="top">
                                <img src="../public/images/instructions.png" alt="instructions">
                                <h3>Special check-in instructions</h3>
                            </div>
                            <p>This property offers transfers from the airport (surcharges may apply); to arrange pick-up, guests must contact the property 24 hours prior to arrival, using the contact information on the booking confirmation.</p>
                            <p>Front desk staff will greet guests on arrival.</p>
                        </div>
                        <!-- Access Methods Section -->
                        <div class="access-methods">
                            <div class="top">
                                <img src="../public/images/accessibility.png" alt="accessibility">
                                <h3>Access Methods</h3>
                            </div>
                            <p>Staffed front desk</p>
                        </div>
                        <!-- Pets Section -->
                        <div class="pets">
                            <div class="top">
                                <img src="../public/images/pawprint.png" alt="pets">
                                <h3>Pets</h3>
                            </div>
                            <p>No pets or service animals allowed</p>
                        </div>
                        <!-- Extra Beds Section -->
                        <div class="extra-beds">
                            <div class="top">
                                <img src="../public/images/extra-bed.png" alt="extra bed">
                                <h3>Children and Extra Beds</h3>
                            </div>
                            <p>Children are welcome</p>
                            <p>Children up to the age of 6 years can stay for free if using existing beds when occupying the parent or guardian's room</p>
                            <p>Rollaway/extra beds are available for LKR 20.0 per night</p>
                            <p>Cribs (infant beds) are not available</p>
                        </div>
                    </div>
                </div>

                <!-- Optional Extras, Need-to-Know, and We Should Mention Sections -->
                <div class="info-two">
                    <div class="optional-extras">
                        <div class="top">
                            <img src="../public/images/ellipsis.png" alt="extra options">
                            <h3>Optional Extras</h3>
                        </div>
                        <p>Fee for buffet breakfast: approximately LKR 4400 for adults and LKR 2200 for children</p>
                        <p>Airport shuttle fee: LKR 12392.75 per vehicle (one-way)</p>
                        <p>Late check-out is available for a fee (subject to availability)</p>
                        <p>Rollaway bed fee: LKR 20.0 per night</p>
                        <p>The above list may not be comprehensive. Fees and deposits may not include tax and are subject to change.</p>
                    </div>

                    <div class="need-to-know">
                        <div class="top">
                            <img src="../public/images/idea.png" alt="need to know">
                            <h3>You Need to Know</h3>
                        </div>
                        <p>Extra-person charges may apply and vary depending on property policy</p>
                        <p>Government-issued photo identification and a credit card, debit card, or cash deposit may be required at check-in for incidental charges</p>
                        <p>Special requests are subject to availability upon check-in and may incur additional charges; special requests cannot be guaranteed</p>
                        <p>This property accepts credit cards, debit cards, and cash</p>
                        <p>This property uses a grey water recycling system</p>
                        <p>Safety features at this property include a fire extinguisher, a security system, and a first aid kit</p>
                        <p>Please note that cultural norms and guest policies may differ by country and by property; the policies listed are provided by the property</p>
                    </div>

                    <div class="we-should-mention">
                        <div class="top">
                            <h3>We Should Mention</h3>
                        </div>
                        <p>Pool access available from 6:00 AM to 9:00 PM</p>
                        <p>Reservations are required for massage services and spa treatments; reservations can be made by contacting the property prior to arrival, using the contact information on the booking confirmation</p>
                        <p>Only registered guests are allowed in the guestrooms</p>
                        <p>The property has connecting/adjoining rooms, which are subject to availability and can be requested by contacting the property using the number on the booking confirmation</p>
                        <p>No pets and no service animals are allowed at this property</p>
                        <p>Parking height restrictions apply</p>
                    </div>
                </div>
            </div>
        </section>



        <!-- Bookings Section -->
        <section class="bookings" id="bookings">
            <div class="book-img">
                <img src="../public/images/book_hotel.png" alt="book img">
            </div>

            <div class="booking-form">
                <h2>Book Your Stay</h2>

                <form action="/submit-booking" method="post">
                    <!-- Check-in Date -->
                    <label for="checkin">Check-in Date:</label>
                    <input type="date" id="check-in" name="check-in" required>

                    <!-- Check-out Date -->
                    <label for="checkout">Check-out Date:</label>
                    <input type="date" id="check-out" name="check-out" required>

                    <!-- Number of Guests -->
                    <label for="guests">Number of Guests:</label>
                    <input type="number" id="guests" name="guests" min="1" required>

                    <!-- Room Type -->
                    <label for="room-type">Room Type:</label>
                    <select id="room-type" name="room-type" required>
                        <option value="single">Single Room</option>
                        <option value="double">Double Room</option>
                        <option value="suite">Suite</option>
                    </select>

                    <!-- Meal Plan Options -->
                    <label for="meals">Meal Plan:</label>
                    <div id="extras">
                        <label><input type="checkbox" name="breakfast" value="breakfast">Breakfast</label>
                        <label><input type="checkbox" name="lunch" value="lunch">Lunch</label>
                        <label><input type="checkbox" name="dinner" value="dinner">Dinner</label>
                        <label><input type="checkbox" name="all" value="all-meals">All Meals</label>
                    </div>

                    <!-- Book Now Button -->
                    <button class="book-btn" type="submit">Book Now</button>
                </form>
            </div>
        </section>

        <!-- review section -->
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


        <section class="contact_us">
            <div class="contact-heading">
                <h2>Contact Us</h2>
                <p>We’d love to hear from you! Get in touch through any of the following ways:</p>
            </div>

            <div class="contact">
                <div class="contact-info">
                    <img class="contact_img" alt="Location" src="../public/images/location.png">
                    <h3>Address</h3>
                    <p><?php echo $hotel['Address']; ?></p>
                </div>

                <div class="contact-info">
                    <img class="contact_img" alt="Opening Hours" src="../public/images/open.png">
                    <h3>Opening Hours</h3>
                    <p>Weekdays: 8 a.m to 10 p.m</p>
                    <p>Weekends: 8 a.m to 12 p.m</p>
                </div>

                <div class="contact-info">
                    <img class="contact_img" alt="Email" src="../public/images/email.png">
                    <h3>Email</h3>
                    <p><?php echo $hotel['Email']; ?></p>
                </div>

                <div class="contact-info">
                    <img class="contact_img" alt="Phone" src="../public/images/phone-call.png">
                    <h3>Phone</h3>
                    <p><?php echo $hotel['ContactNo']; ?></p>
                </div>
            </div>

            <div class="share">
                <?php if (!empty($hotel['TikTokLink'])) : ?>
                    <a href="<?php echo $hotel['TikTokLink']; ?>" class="social-link"><img alt="Tiktok" src="../public/images/tiktok.webp"></a>
                <?php endif; ?>
                <?php if (!empty($hotel['FacebookLink'])) : ?>
                    <a href="<?php echo $hotel['FacebookLink']; ?>" class="social-link"><img alt="Facebook" src="../public/images/facebook.png"></a>
                <?php endif; ?>
                <?php if (!empty($hotel['InstagramLink'])) : ?>
                    <a href="<?php echo $hotel['InstagramLink']; ?>" class="social-link"><img alt="Instagram" src="../public/images/instagram.png"></a>
                <?php endif; ?>
                <?php if (!empty($hotel['YoutubeLink'])) : ?>
                    <a href="<?php echo $hotel['YoutubeLink']; ?>" class="social-link"><img alt="YouTube" src="../public/images/youtube.png"></a>
                <?php endif; ?>
            </div>
        </section>

    </div>
    <div class="review-button-container1">
        <a href="http://localhost/ExploreEase/review?type=<?= urlencode($type) ?>&id=<?= urlencode($id) ?>" class="review-button1">Add a Review</a>
    </div>
    <?php require_once __DIR__ . "/../logedFooter.php"; ?>

    <script>
        function initMap() {
            // Pull the PHP vars into JS
            const lat = parseFloat("<?= $hotel['Latitude']; ?>");
            const lng = parseFloat("<?= $hotel['Longitude']; ?>");

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
                title: "<?= htmlspecialchars($hotel['Name'], ENT_QUOTES); ?>",
                label: {
                    text: "<?= htmlspecialchars($hotel['Name'], ENT_QUOTES); ?>",
                    color: "white",
                    fontSize: "12px",
                    fontWeight: "bold"
                }
            });
        }
    </script>
</body>

</html>