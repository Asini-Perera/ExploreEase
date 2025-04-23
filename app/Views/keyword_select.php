<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Sri Lanka</title>
    <link rel="stylesheet" href="../public/css/selectKeywords.css?v=1">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/logedFooter.css?v=1">
</head>

<body>
    <?php require_once __DIR__ . '/Navbar.php'; ?>
    <main>
        <section class="explore-section" aria-labelledby="main-heading">
            <header class="hero-container">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/07f99c8b75a628dd8375eeb83fa2e5bbc9a50211e8eb020e2f7cb24ee36dfb2c?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="Scenic landscape of Sri Lanka" class="hero-image" />
                <div class="hero-content">
                    <h1 id="main-heading" class="hero-title">Explore The<br />Most Beautiful Places<br />Around Sri Lanka</h1>
                    <p class="location-prompt" id="location-label">where are you located now?</p>
                    <form class="search-container" role="search" aria-labelledby="location-label">
                        <div class="search-input-group">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc1de7bb3105164d1745555a0ae8ef7f54747be425d0d898d1f3526f3dd70df0?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="" class="search-icon" aria-hidden="true" />
                            <input type="text"
                                id="location-search"
                                class="search-placeholder"
                                placeholder="Try 'Mount Lavinia'"
                                aria-label="Search location" />
                        </div>
                        <div class="vertical-divider" role="separator" aria-hidden="true"></div>
                        <button type="button" class="locate-group" aria-label="Use current location">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/8427c59ebeb624f0a13ae0f7cfbcc59782e5b955ca6afc044ccec2f1ab90e6ed?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="" class="locate-icon" aria-hidden="true" />
                            <span class="locate-text">Locate Me</span>
                        </button>
                    </form>
                </div>
                <section class="filters-section" aria-labelledby="destination-filters">
                    <?php foreach ($categories as $category) : ?>
                        <nav aria-label="Destination type filters">
                            <h2 id="destination-filters" class="section-title"><?= htmlspecialchars($category['CategoryName']) ?></h2>
                            <ul class="filter-list" role="list">
                                <?php foreach ($category['keywords'] as $keyword) : ?>
                                    <li><button class="option-group" type="button">
                                            <input type="checkbox" name="amenities" value="<?= htmlspecialchars($keyword['KName']) ?>" aria-labelledby="<?= htmlspecialchars($keyword['KName']) ?>-label" />
                                            <span><?= htmlspecialchars($keyword['KName']) ?></span>
                                        </button>
                                    </li>
                                <?php endforeach; ?>
                            </ul>
                        </nav>
                    <?php endforeach; ?>
                    <!-- <nav aria-label="Destination type filters">
                        <h2 id="destination-filters" class="section-title">Where would you prefer to stay?</h2>

                        <ul class="filter-list" role="list">
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>City Center</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Beachside</span>
                                </button>
                            </li>
                            <li>
                                <button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Rural Area</span>
                                </button>
                            </li>
                            <li>
                                <button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Near Public Transport</span>
                                </button>
                            </li>
                            <li>
                                <button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Mountain View</span>
                                </button>
                            </li>
                        </ul>
                    </nav>

                    <nav aria-label="Destination type filters">
                        <h2 id="travel-style" class="section-title">What kind of experience are you looking for during your stay?</h2>
                        <ul class="filter-list" role="list">
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Family-Friendly</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Kid-Friendly</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Luxury Experience</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Adventure-Focused</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Budget-Friendly</span>
                                </button>
                            </li>

                        </ul>
                    </nav>

                    <nav aria-label="Destination type filters">
                        <h2 id="travel-style" class="section-title">Which of these services are most important to you?</h2>
                        <ul class="filter-list" role="list">
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Online Booking</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>24/7 Availability</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Loyalty Programs</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Group Discounts</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Customer Support</span>
                                </button>
                            </li>

                        </ul>
                    </nav>

                    <nav aria-label="Destination type filters">
                        <h2 id="travel-style" class="section-title">How important are these ratings and reviews to you when choosing where to stay?</h2>
                        <ul class="filter-list" role="list">
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Highly Rated</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Top Reviewed</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>New on Platform</span>
                                </button>
                            </li>
                            <li><button class="option-group" type="button">
                                    <input type="checkbox" name="amenities" value="wifi" aria-labelledby="wifi-label" />
                                    <span>Trusted Vendor</span>
                                </button>
                            </li>


                        </ul>
                    </nav> -->
                </section>

        </section>
        <div class="next-button-container">
            <a href='http://localhost/ExploreEase/search/keyword' class="next-button-link">
                <button id="next-button">Next</button>
            </a>
        </div>
        </header>


    </main>
    <?php require_once __DIR__ . '/logedFooter.php'; ?>
</body>

</html>