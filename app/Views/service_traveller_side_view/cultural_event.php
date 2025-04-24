<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>event</title>
    <link rel="stylesheet" href="../public/css/service_traveller_side_view/cultural_event.css">
    <link rel="stylesheet" href="../public/css/logedFooter.css?v=1">
</head>

<body>
    <!-- header -->
    <?php require_once __DIR__ . "/../Navbar.php"; ?>
    <header>
        <div class="container">
            <h1 class="c-name">ABC Cultural Center</h1>
            <h3 class="describe">Where Tradition Meets Celebration</h3>
        </div>
    </header>

    <!-- nav-bar -->
    <section class="nav-bar">
        <nav>
            <ul class="nav-links">
                <li><a href="#about">Overview</a></li>
                <li><a href="#info">Info&Prices</a></li>
                <li><a href="#facilities">Memory</a></li>
                <li><a href="#bookings">Bookings</a></li>
                <li><a href="#reviews">Reviews</a></li>
            </ul>
        </nav>
    </section>

    <section class="about-section" id="about">
        <div class="map-gallery">
            <div class="map">
                <img src="../public/images/google-map.jpg" alt="Map of ABC Cultural Center">
            </div>

            <div class="gallery">
                <div class="gallery-one">
                    <div class="gallery-row">
                        <div class="gallery-img">
                            <img src="../public/images/tradition.jpg" alt="Traditional Art" class="gallery1-image1">
                        </div>
                        <div class="gallery-img">
                            <img src="../public/images/traditional-dancing.jpg" alt="Traditional Dancing" class="gallery1-image2">
                        </div>
                    </div>
                    <div class="gallery-main">
                        <img src="../public/images/yaka.jpg" alt="Yaka Mask Dance" class="gallery-main-image">
                    </div>
                    <div class="gallery-row">
                        <div class="gallery-img">
                            <img src="../public/images/baratha.jpg" alt="Bharatanatyam Dance" class="gallery1-image3">
                        </div>
                        <div class="gallery-img">
                            <img src="../public/images/kolam.png" alt="Kolam Performance" class="gallery1-image4">
                        </div>
                    </div>
                </div>
                <div class="gallery-two">
                    <div class="gallery-img">
                        <img src="../public/images/kolamdance01.jpg" alt="Kolam Dance" class="gallery2-image1">
                    </div>
                    <div class="gallery-img">
                        <img src="../public/images/rukada.jpg" alt="Rukada Puppet Performance" class="gallery2-image2">
                    </div>
                    <div class="gallery-img">
                        <img src="../public/images/wes.jpg" alt="Wes Dance" class="gallery2-image3">
                    </div>
                    <div class="gallery-img">
                        <img src="../public/images/traditional-danse-2.jpg" alt="Traditional Dance" class="gallery2-image4">
                    </div>
                </div>
            </div>
        </div>
        <div class="about">
            <div class="content">
                <h3 class="abt-title">Welcome to ABC Cultural Center</h3>
                <p class="description">
                    Immerse yourself in the vibrant world of art, culture, and traditions. At ABC Cultural Center, we celebrate heritage through captivating festivals, performances, and enriching workshops.
                </p>
                <p class="description">
                    Whether you're here to enjoy, learn, or create, our welcoming atmosphere and modern facilities make every moment unforgettable.
                </p>
                <a href="#learn-more" class="btn-primary">Learn More</a>
            </div>
        </div>

    </section>

    <section class="info" id="info">
        <div class="info-slider">
            <div class="info-list">
                <div class="slide">
                    <img src="../public/images/yaka.jpg" alt="event" class="event-img">
                    <h3 class="slide-title">Year-End Cultural Feasta!</h3>
                    <p class="slide-description">Join us for an unforgettable cultural festival on <strong>2nd Dec 2024</strong>, from <strong>6 PM to 9 PM</strong>.</p>
                    <h4 class="slide-subtitle">Ticket Prices</h4>
                    <ul class="ticket-prices">
                        <li><strong>Adult:</strong> Rs. 2000.00</li>
                        <li><strong>Children:</strong> Rs. 1000.00</li>
                    </ul>
                    <button class="btn-more">More Details</button>
                </div>

                <div class="slide">
                    <img src="../public/images/baratha.jpg" alt="event" class="event-img">
                    <h3 class="slide-title">Year-End Cultural Feasta!</h3>
                    <p class="slide-description">Join us for an unforgettable cultural festival on <strong>2nd Dec 2024</strong>, from <strong>6 PM to 9 PM</strong>.</p>
                    <h4 class="slide-subtitle">Ticket Prices</h4>
                    <ul class="ticket-prices">
                        <li><strong>Adult:</strong> Rs. 2000.00</li>
                        <li><strong>Children:</strong> Rs. 1000.00</li>
                    </ul>
                    <button class="btn-more">More Details</button>
                </div>

                <div class="slide">
                    <img src="../public/images/yaka.jpg" alt="event" class="event-img">
                    <h3 class="slide-title">Year-End Cultural Feasta!</h3>
                    <p class="slide-description">Join us for an unforgettable cultural festival on <strong>2nd Dec 2024</strong>, from <strong>6 PM to 9 PM</strong>.</p>
                    <h4 class="slide-subtitle">Ticket Prices</h4>
                    <ul class="ticket-prices">
                        <li><strong>Adult:</strong> Rs. 2000.00</li>
                        <li><strong>Children:</strong> Rs. 1000.00</li>
                    </ul>
                    <button class="btn-more">More Details</button>
                </div>

                <div class="slide">
                    <img src="../public/images/baratha.jpg" alt="event" class="event-img">
                    <h3 class="slide-title">Year-End Cultural Feasta!</h3>
                    <p class="slide-description">Join us for an unforgettable cultural festival on <strong>2nd Dec 2024</strong>, from <strong>6 PM to 9 PM</strong>.</p>
                    <h4 class="slide-subtitle">Ticket Prices</h4>
                    <ul class="ticket-prices">
                        <li><strong>Adult:</strong> Rs. 2000.00</li>
                        <li><strong>Children:</strong> Rs. 1000.00</li>
                    </ul>
                    <button class="btn-more">More Details</button>
                </div>
            </div>
        </div>
    </section>

    <section class="memories" id="memories">
        <div class="title">
            <h2 class="title-text">Our Memories</h2>
        </div>

        <div class="memory">
            <div id="year-buttons" class="year-buttons">
                <button class="year-button" data-year="2020">2020</button>
                <button class="year-button" data-year="2021">2021</button>
                <button class="year-button" data-year="2022">2022</button>
                <button class="year-button" data-year="2023">2023</button>
            </div>
            <div id="action-buttons" class="action-buttons">
                <button class="action-button about-button" id="about-button" disabled>About</button>
                <button class="action-button images-button" id="images-button" disabled>Images</button>
                <button class="action-button videos-button" id="videos-button" disabled>Videos</button>
            </div>
            <div id="memory-container" class="memory-container">
                <h2 class="memory-title">Annual Cultural Feasta – Traditional Dancing Event (Held on 30th May 2023)</h2>
                <p class="memory-description">The Annual Cultural Feasta held on 30th May 2023 was a spectacular celebration of tradition and heritage, bringing together people from all walks of life to honor the region’s rich cultural history through an evening of Traditional Dancing.</p>
                <p class="memory-description">The event showcased vibrant dance styles with traditional music, leaving attendees mesmerized by the storytelling and colorful costumes. It fostered a deeper appreciation for cultural roots, making it a memorable highlight of the year.</p>
                <p class="memory-description">This unforgettable evening exemplified the unity and beauty of heritage through the vibrant art of Traditional Dancing.</p>
            </div>
        </div>
    </section>


<!-- bookings -->
<section class="bookings" id="bookings">
    <div class="bookings-content">
        <img src="../public/images/ticket.png" alt="Ticket" class="booking-image">
        <div class="ticket-purchase">
            <form action="">
                <h3 class="booking-heading">Buy a Ticket</h3>
                <input type="text" placeholder="Name" required>
                <input type="email" placeholder="Email" required>
                <input type="tel" placeholder="Phone" pattern="[0-9]{10}" required>
                <input type="text" placeholder="Event Name" required>
                <input type="date" required>
                <input type="time" class="booking-time" required>
                <label for="num_tickets" class="num-tickets">Number of Tickets</label>
                <input type="number" min="1" max="25" placeholder="Guests" class="num-members" required>
                <button type="submit" class="book-button">Purchase Now</button>
            </form>
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
                <p>123 Main Street,<br> New York,<br> NY 10001</p>
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
                <p>abcresturat@gmail.com</p>
            </div>

            <div class="contact-info">
                <img class="contact_img" alt="Phone" src="../public/images/phone-call.png">
                <h3>Phone</h3>
                <p>0112 456987</p>
                <p>0112 789632</p>
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
        <a href="http://localhost/ExploreEase/heritagemarket/review" class="review-button1">Add a Review</a>
    </div>
    <?php require_once __DIR__ . "/../logedFooter.php"; ?>
    <script src="../public/js/event.js"> </script>
</body>

</html>