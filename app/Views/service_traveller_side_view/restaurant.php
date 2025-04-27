<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resturant</title>
    <link rel="stylesheet" href="../public/css/service_traveller_side_view/restaurant.css">
    <link rel="stylesheet" href="../public/css/logedFooter.css?v=1">
</head>

<body>
    <?php require_once __DIR__ . "/../Navbar.php"; ?>
    <div class="main-container">

        <header>

            <div class="container">
                <h1 class="r-name"><?php echo $restaurant['Name']; ?></h1>
                <h3 class="describe"><?php echo $restaurant['Tagline']; ?></h3>

            </div>
        </header>

        <!-- nav-bar -->
        <section class="nav-bar">
            <nav>
                <ul class="nav-links">
                    <li><a href="#about">Overview</a></li>
                    <li><a href="#full_menu">Menu</a></li>
                    <li><a href="#table-booking">Bookings</a></li>
                    <li><a href="#reviews">Reviews</a></li>
                </ul>
            </nav>
        </section>


        <!-- about -->
        <section class="about-section" id="about">

            <div class="map-gallery">
                <div class="map">
                    <img src="../public/images/google-map.jpg" alt="map" class="map-img">
                </div>

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
                    <h3 class="abt-title">Welcome to Our Restaurant</h3>
                    <p class="description">
                        <?php echo $restaurant['Description']; ?>
                    </p>
                </div>
            </div>


        </section>
        <!-- Food Section -->
        <section class="food" id="food">
            <div class="food-heading">
                <span>Popular Dishes</span>
                <h3>Our Delicious Food</h3>
            </div>
        
<!-- Food Section -->
<section class="food" id="food">
    <div class="food-heading">
        <span>Popular Dishes</span>
        <h3>Our Delicious Food</h3>
    </div>

            <div class="food-slider">
                <div class="food-list">
                    <!-- Food Item -->
                    <div class="slide">
                        <img src="../public/images/burger.jpg" alt="burger" class="food-img">
                        <div class="food-info">
                            <h3>Burger</h3>
                            <div class="price">RS.450.00</div>
                        </div>
                    </div>

                    <div class="slide">
                        <img src="../public/images/creamy-pasta.jpg" alt="creamy-pasta" class="food-img">
                        <div class="food-info">
                            <h3>Creamy Pasta</h3>
                            <div class="price">RS.650.00</div>
                        </div>
                    </div>

                    <div class="slide">
                        <img src="../public/images/chorizo-pasta.jpg" alt="chorizo-pasta" class="food-img">
                        <div class="food-info">
                            <h3>Chorizo Pasta</h3>
                            <div class="price">RS.750.00</div>
                        </div>
                    </div>

                    <div class="slide">
                        <img src="../public/images/sandwitch.jpg" alt="sandwich" class="food-img">
                        <div class="food-info">
                            <h3>Sandwich</h3>
                            <div class="price">RS.350.00</div>
                        </div>
                    </div>

                    <div class="slide">
                        <img src="../public/images/root-vegetable-soap.jpg" alt="root-vegetable-soup" class="food-img">
                        <div class="food-info">
                            <h3>Root Vegetable Soup</h3>
                            <div class="price">RS.800.00</div>
                        </div>
                    </div>

                    <div class="slide">
                        <img src="../public/images/thai-curry-soap.jpg" alt="thai-curry-soup" class="food-img">
                        <div class="food-info">
                            <h3>Thai Curry Soup</h3>
                            <div class="price">RS.750.00</div>
                        </div>
                    </div>

                    <div class="slide">
                        <img src="../public/images/spring-rolls.jpg" alt="spring-rolls" class="food-img">
                        <div class="food-info">
                            <h3>Spring Rolls</h3>
                            <div class="price">RS.450.00</div>
                        </div>
                    </div>

                    <div class="slide">
                        <img src="../public/images/rasberry-white-chocolate-mousse.jpg" alt="rasberry-white-chocolate-mousse" class="food-img">
                        <div class="food-info">
                            <h3>Raspberry White Chocolate Mousse</h3>
                            <div class="price">RS.450.00</div>
                        </div>
                    </div>

                </div>
            </div>
        </section>


        <!-- menu -->
        <section class="full_menu" id="full_menu">
            <div>
                <h1 class="menu_headin">Menu</h1>
                <p class="menu_description">Our menu is a celebration of both classic and innovative flavors, offering a variety of dishes that will captivate your taste buds and elevate your dining experience. From delicate appetizers to indulgent entrees and decadent desserts, every bite is designed to delight.</p>
                <button class="menu_btn"><a href="http://localhost/ExploreEase/service/menu" class="full_menu-link">Discover Menu PDF</a></button>
            </div>

            <img class="menu_img" src="../public/images/menu.jpg" alt="menu">
        </section>





        <!-- Table Booking Section -->
        <section class="table-booking" id="table-booking">
            <div class="booking-image">
                <img src="../public/images/book_table.jpg" alt="booking">
            </div>

            <div class="booking-form">
                <form action="service/restaurant" method="post">
                    <h3 class="booking-heading">Book a Table</h3>
                    <input type="text" name="customer_name" placeholder="Your Name" class="input-field" required>
                    <input type="email" name="email" placeholder="Your Email" class="input-field" required>
                    <!-- <input type="text" placeholder="Phone Number" class="input-field" required> -->
                    <input type="date" name="date_booking" placeholder="Select Date" class="input-field" required>
                    <input type="time" name="time_booking" placeholder="Select Time" class="input-field booking-time" required>
                    <input type="number" name="no_people" min="1" max="25" placeholder="Number of Guests" class="input-field guests" required>
                    <textarea name="special_Request" placeholder="Special Requests" rows="5" class="input-field special-request"></textarea>

                    <input type="hidden" name="restaurant_id" value="<?= $restaurantID ?>">
                    <input type="hidden" name="traveler_id" value="<?= $travelerID ?>">


                    <button type="submit" class="book-btn" onclick="openPopup()">Book Now</button>
                </form>

                <!-- Popup Confirmation -->
                <div class="popup" id="popup">
                    <div class="popup-content">
                        <h3>Thank you for booking a table with us!</h3>
                        <p>Your booking has been confirmed. We will send you your table number shortly. We look forward to welcoming you to our restaurant.</p>
                        <button id="ok" class="popup-btn" onclick="closePopup()">OK</button>
                    </div>
                </div>
            </div>
        </section>


        <!-- reviews -->
        <section class="reviews" id="reviews">
            <div class="review-heading">
                <h2>What Our Customers Say</h2>
                <p>See what our guests have to say about their experience</p>
            </div>

            <div class="review-container">
                <div class="review-slide">
                    <div class="review">
                        <div class="customer-info">
                            <div class="customer-pic">
                                <a href="#"> <img src="../public/images/men.jpg" alt="Customer Image"></a>
                            </div>
                            <div class="customer-details">
                                <h5>Jane Koch</h5>
                                <span class="rating">&#9733;&#9733;&#9733;&#9733;&#9733;</span> <!-- Star Rating -->
                            </div>
                        </div>

                        <p class="review-msg">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</p>
                    </div>

                    <div class="response">
                        <p>Thank you for your review! We’re glad you enjoyed your stay. Hope to welcome you again soon!</p>
                    </div>
                </div>

                <!-- Repeat for other reviews -->
                <div class="review-slide">
                    <div class="review">
                        <div class="customer-info">
                            <div class="customer-pic">
                                <a href="#"> <img src="../public/images/women-1.jpg" alt="Customer Image"></a>
                            </div>
                            <div class="customer-details">
                                <h5>John Wilson</h5>
                                <span class="rating">&#9733;&#9733;&#9733;&#9733;&#9734;</span>
                            </div>
                        </div>

                        <p class="review-msg">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</p>
                    </div>

                    <div class="response">
                        <p>Thank you for your review! We’re glad you enjoyed your stay. We hope to see you again soon!</p>
                    </div>

                </div>
                <div class="review-slide">
                    <div class="review">
                        <div class="customer-info">
                            <div class="customer-pic">
                                <a href="#"> <img src="../public/images/men.jpg" alt="Customer Image"></a>
                            </div>
                            <div class="customer-details">
                                <h5>Jane Koch</h5>
                                <span class="rating">&#9733;&#9733;&#9733;&#9733;&#9733;</span> <!-- Star Rating -->
                            </div>
                        </div>

                        <p class="review-msg">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s...</p>
                    </div>

                    <div class="response">
                        <p>Thank you for your review! We’re glad you enjoyed your stay. Hope to welcome you again soon!</p>
                    </div>
                </div>


                <!-- Add more review slides similarly -->
            </div>

            <div class="carousel-controls">
                <button class="prev">&#10094;</button>
                <button class="next">&#10095;</button>
            </div>
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
                    <p><?php echo $restaurant['Address']; ?></p>
                </div>

                <div class="contact-info">
                    <img class="contact_img" alt="Opening Hours" src="../public/images/open.png">
                    <h3>Opening Hours</h3>
                    <p>Weekdays: <?php echo $restaurant['WeekdayOpenHours']; ?></p>
                    <p>Weekends: <?php echo $restaurant['WeekendOpenHours']; ?></p>
                </div>

                <div class="contact-info">
                    <img class="contact_img" alt="Email" src="../public/images/email.png">
                    <h3>Email</h3>
                    <p><?php echo $restaurant['Email']; ?></p>
                </div>

                <div class="contact-info">
                    <img class="contact_img" alt="Phone" src="../public/images/phone-call.png">
                    <h3>Phone</h3>
                    <p><?php echo $restaurant['ContactNo']; ?></p>
                </div>
            </div>

            <div class="share">
                <a href="https://www.twitter.com/" class="social-link"><img alt="Twitter" src="../public/images/twitter.png"></a>
                <a href="https://www.facebook.com/" class="social-link"><img alt="Facebook" src="../public/images/facebook.png"></a>
                <a href="https://www.instagram.com/" class="social-link"><img alt="Instagram" src="../public/images/instagram.png"></a>
                <a href="https://www.youtube.com/" class="social-link"><img alt="YouTube" src="../public/images/youtube.png"></a>
            </div>
        </section>
    </div>
    <div class="review-button-container1">
        <a href="http://localhost/ExploreEase/review?type=<?= urlencode($type) ?>&id=<?= urlencode($id) ?>" class="review-button1">Add a Review</a>

    </div>
    <?php require_once __DIR__ . "/../logedFooter.php"; ?>
    <script src="../public/js/restaurant.js"></script>
</body>

</html>