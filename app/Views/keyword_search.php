<?php
$places = $_SESSION['places'] ?? [];
$latitude = $_SESSION['latitude'] ?? null;
$longitude = $_SESSION['longitude'] ?? null;
// unset($_SESSION['places']);
// 
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Section</title>

    <link rel="stylesheet" href="../public/css/logedFooter.css?v=1">
    <link rel="stylesheet" href="../public/css/searchbykeyword.css?v=1">
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBHabPak9APZk-8qvZs4j_qNkTl_Pk0aF8"></script>
</head>

<body>
    <?php require_once __DIR__ . '/loggedNavbar.php'; ?>
    <main>
        <section class="search-by-keywords" aria-label="Explore Sri Lanka">
            <div class="content-wrapper">
                <div class="hero-section">
                    <h1>Explore Sri Lanka</h1>
                    <p>Based on your location and interests</p>
                </div>
                <!-- <nav aria-label="Interest categories">
                    <ul class="interest-categories">
                        <li><button type="button">Culture</button></li>
                        <li><button type="button">History</button></li>
                        <li><button type="button">Beach</button></li>
                        <li><button type="button">Food</button></li>
                        <li><button type="button">Adventure</button></li>
                    </ul>
                </nav> -->
                <section aria-labelledby="top-attractions-heading">
                    <h2 id="top-attractions-heading">Nearest places</h2>
                    <p style="font-style: italic; color: gray;">Note: Distances are calculated as the crow flies and differ from actual travel distances.</p>
                    <ul class="attractions-list">
                        <?php foreach ($places as $place) : ?>
                            <li>
                                <article>
                                    <a href="../link/service?type=<?= urlencode($place['type']) ?>&id=<?= urlencode($place['ID']) ?>">
                                        <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/c357e84f788a8987722a2333aa2b59d3729cd04b5922ac958422ecbeb48613e1?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="<?= htmlspecialchars($place['Name']) ?>" loading="lazy">
                                    </a>
                                    <h3><?= htmlspecialchars($place['Name']) ?></h3>
                                    <p>
                                        <?php
                                        if ($place['type'] === 'heritagemarket') {
                                            echo 'Heritage Market';
                                        } elseif ($place['type'] === 'hotel') {
                                            echo 'Hotel';
                                        } elseif ($place['type'] === 'restaurant') {
                                            echo 'Restaurant';
                                        } else {
                                            echo htmlspecialchars($place['type']);
                                        }
                                        ?>
                                    </p>
                                    <p><?= htmlspecialchars($place['Distance']) ?> km</p>

                                </article>
                            </li>
                        <?php endforeach; ?>
                        <!-- <li>
                            <article>
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/c357e84f788a8987722a2333aa2b59d3729cd04b5922ac958422ecbeb48613e1?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="Galle Face Green" loading="lazy">
                                <h3>Galle Face Green</h3>
                                <p>Park</p>
                            </article>
                        </li>
                        <li>
                            <article>
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/a7b93cf0694f908a45fc6267b5608706b3a28b03ca780389b48a0dcc4fe1e262?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="National Museum of Colombo" loading="lazy">
                                <h3>National Museum of Colombo</h3>
                                <p>Museum</p>
                            </article>
                        </li>
                        <li>
                            <article>
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/d390612f315b0beb17bf977c5e3f0cc86cb3db6d2374d9176ed1c8512a42eea3?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="Beira Lake" loading="lazy">
                                <h3>Beira Lake</h3>
                                <p>Lake</p>
                            </article>
                        </li>
                        <li>
                            <article>
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/2070c27fd3f574484ab130e6495f9f5acacf8d6c713926e31092c806dcfdf369?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="Viharamahadevi Park" loading="lazy">
                                <h3>Viharamahadevi Park</h3>
                                <p>Park</p>
                            </article>
                        </li>
                        <li>
                            <article>
                                <img src="https://cdn.builder.io/api/v1/image/assets/TEMP/3b2697b7d0fbea615840c8bcd8ad04321e4006aff4655f6783bfb6fc107b60f2?placeholderIfAbsent=true&apiKey=133f3dae0e9c43f59e9b763518a0651f" alt="Independence Memorial Hall" loading="lazy">
                                <h3>Independence Memorial Hall</h3>
                                <p>Memorial</p>
                            </article>
                        </li> -->
                    </ul>
                </section>
                <!-- <button type="button" class="show-more">Show more</button> -->
                <h2>Map View</h2>
                <p>Click on the markers to see more details about each location.</p>
                <div id="map" class="map-container" aria-label="Map of attractions" style="height:500px; width:100%;">
                    <!-- The Google Map will be rendered here -->
                </div>




                <script>
                    const placesFromPHP = <?php echo json_encode($places, JSON_NUMERIC_CHECK); ?>;

                    console.log("placesFromPHP =", placesFromPHP);
                    if (placesFromPHP.length) {
                        console.log("Places found:", placesFromPHP);
                    } else {
                        console.log("No places found.");
                    }

                    function initMap() {
                        const map = new google.maps.Map(document.getElementById('map'), {
                            center: {
                                lat: <?= $latitude ?>,
                                lng: <?= $longitude ?>
                            }, // Default center (Colombo)
                            zoom: 10,
                        });

                        if (!placesFromPHP.length) {
                            alert("No places found for the selected keywords.");
                            return;
                        }

                        // placesFromPHP.forEach(place => {
                        //     const marker = new google.maps.Marker({
                        //         position: {
                        //             lat: parseFloat(place.Latitude),
                        //             lng: parseFloat(place.Longitude)
                        //         },
                        //         map: map,
                        //         title: place.Name,
                        //     });

                        //     const infoWindow = new google.maps.InfoWindow({
                        //         content: `<h3>${place.Name}</h3><p>${place.Description}</p>`,
                        //     });

                        //     marker.addListener('click', () => {
                        //         infoWindow.open(map, marker);
                        //     });
                        // });

                        placesFromPHP.forEach(place => {
                            const markerColor = place.type === 'hotel' ?
                                'http://maps.google.com/mapfiles/ms/icons/blue-dot.png' :
                                place.type === 'restaurant' ?
                                'http://maps.google.com/mapfiles/ms/icons/red-dot.png' :
                                place.type === 'heritagemarket' ?
                                'http://maps.google.com/mapfiles/ms/icons/yellow-dot.png' :
                                'http://maps.google.com/mapfiles/ms/icons/green-dot.png';

                            const marker = new google.maps.Marker({
                                position: {
                                    lat: parseFloat(place.Latitude),
                                    lng: parseFloat(place.Longitude)
                                },
                                map: map,
                                title: place.Name,
                                icon: {
                                    url: markerColor
                                },
                                label: {
                                    text: place.Name,
                                    color: "white",
                                    fontSize: "12px",
                                    fontWeight: "bold"
                                }
                            });

                            const infoWindow = new google.maps.InfoWindow({
                                content: `<a href="../link/service?type=${encodeURIComponent(place.type)}&id=${encodeURIComponent(place.ID)}"><h3>${place.Name}</h3></a><p>${place.Tagline}</p><p><strong>Type:</strong> ${place.type}</p>`,
                            });

                            marker.addListener('click', () => {
                                infoWindow.open(map, marker);
                            });
                        });

                        if (<?= $latitude && $longitude ? 'true' : 'false' ?>) {
                            const currentLocationMarker = new google.maps.Marker({
                                position: {
                                    lat: <?= $latitude ?>,
                                    lng: <?= $longitude ?>
                                },
                                map: map,
                                title: "Your Current Location",
                                icon: {
                                    url: "https://maps.google.com/mapfiles/kml/shapes/man.png", // 👈 a human marker icon
                                    scaledSize: new google.maps.Size(40, 40) // optional: scale the icon
                                }
                            });

                            const currentLocationInfo = new google.maps.InfoWindow({
                                content: `<h3>Your Current Location</h3>`
                            });

                            currentLocationMarker.addListener('click', () => {
                                currentLocationInfo.open(map, currentLocationMarker);
                            });
                        }


                    }

                    window.onload = initMap;
                </script>


            </div>
        </section>
    </main>
    <?php require_once __DIR__ . '/logedFooter.php'; ?>
</body>

</html>