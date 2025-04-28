<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Explore Sri Lanka</title>
    <link rel="stylesheet" href="../public/css/selectKeywords.css?v=1">
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link href="https://fonts.googleapis.com/css2?family=Josefin+Slab:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="../public/css/logedFooter.css?v=1">
</head>

<body>
    <?php require_once __DIR__ . '/loggedNavbar.php'; ?>
    <main>
        
            <header class="hero-container">
                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/07f99c8b75a628dd8375eeb83fa2e5bbc9a50211e8eb020e2f7cb24ee36dfb2c?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="Scenic landscape of Sri Lanka" class="hero-image" />
                <div class="hero-content">
                    <h1 id="main-heading" class="hero-title">Explore The<br />Most Beautiful Places<br />Around Sri Lanka</h1>
                    <p class="location-prompt" id="location-label">Where are you located now?</p>
                    <form class="search-container" role="search" aria-labelledby="location-label">
                        <!-- <div class="search-input-group">
                            <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/cc1de7bb3105164d1745555a0ae8ef7f54747be425d0d898d1f3526f3dd70df0?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="" class="search-icon" aria-hidden="true" />
                            <input type="text"
                                id="location-search"
                                class="search-placeholder"
                                placeholder="Try 'Mount Lavinia'"
                                aria-label="Search location" />
                        </div> -->
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
                <div class="filter-column">
                    <?php foreach ($category['keywords'] as $keyword) : ?>
                        <li>
                            <button class="option-group" type="button">
                                <input type="checkbox" name="amenities" value="<?= htmlspecialchars($keyword['KeywordID']) ?>" aria-labelledby="<?= htmlspecialchars($keyword['KName']) ?>-label" />
                                <span><?= htmlspecialchars($keyword['KName']) ?></span>
                            </button>
                        </li>
                    <?php endforeach; ?>
                </div>
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
                    </nav> -->
            </section>


                <div class="next-button-container">
                    <form id="keyword-location-form" method="POST" action="http://localhost/ExploreEase/filter/keyword">
                        <input type="hidden" name="latitude" id="latitude">
                        <input type="hidden" name="longitude" id="longitude">
                        <input type="hidden" name="keyword_ids" id="keyword_ids">
                        <button type="submit" id="next-button">Next</button>
                    </form>
                </div>
            </header>

        </section>
    </main>
    <?php require_once __DIR__ . '/logedFooter.php'; ?>

    <script>
        let selectedKeywordIDs = [];
        let currentLatitude = null;
        let currentLongitude = null;

        // Get location on clicking "Locate Me"
        document.querySelector('.locate-group').addEventListener('click', () => {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(
                    (position) => {
                        currentLatitude = position.coords.latitude;
                        currentLongitude = position.coords.longitude;
                        console.log("Location fetched:", currentLatitude, currentLongitude);
                    },
                    (error) => {
                        alert("Location permission denied or unavailable.");
                    }
                );
            } else {
                alert("Geolocation is not supported in this browser.");
            }
        });

        // Track selected checkboxes
        document.querySelectorAll('input[type="checkbox"][name="amenities"]').forEach((checkbox) => {
            checkbox.addEventListener('change', () => {
                const value = checkbox.value;
                if (checkbox.checked) {
                    if (!selectedKeywordIDs.includes(value)) {
                        selectedKeywordIDs.push(value);
                    }
                } else {
                    selectedKeywordIDs = selectedKeywordIDs.filter(id => id !== value);
                }
                console.log("Selected Keyword IDs:", selectedKeywordIDs);
            });
        });

        // Before form submission: attach data to hidden fields
        document.getElementById('keyword-location-form').addEventListener('submit', function(e) {
            if (currentLatitude === null || currentLongitude === null) {
                e.preventDefault();
                alert("Please click 'Locate Me' to allow location access before proceeding.");
                return;
            }

            document.getElementById('latitude').value = currentLatitude;
            document.getElementById('longitude').value = currentLongitude;
            document.getElementById('keyword_ids').value = JSON.stringify(selectedKeywordIDs); // Send as JSON string
        });
    </script>

</body>

</html>