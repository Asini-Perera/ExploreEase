<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Navigation Section</title>
    
   
    <link rel="stylesheet" href="../public/css/searchbykeyword.css?v=1">
</head>
<body>
    <?php require_once __DIR__ . '/Navbar.php'; ?>
     <main>
        <section class="search-by-keywords" aria-label="Explore Sri Lanka">
            <div class="content-wrapper">
                <div class="hero-section">
                    <h1>Explore Sri Lanka</h1>
                    <p>Based on your location and interests</p>
                </div>
                <nav aria-label="Interest categories">
                    <ul class="interest-categories">
                        <li><button type="button">Culture</button></li>
                        <li><button type="button">History</button></li>
                        <li><button type="button">Beach</button></li>
                        <li><button type="button">Food</button></li>
                        <li><button type="button">Adventure</button></li>
                    </ul>
                </nav>
                <section aria-labelledby="top-attractions-heading">
                    <h2 id="top-attractions-heading">Top attractions</h2>
                    <ul class="attractions-list">
                        <li>
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
                        </li>
                    </ul>
                </section>
                <button type="button" class="show-more">Show more</button>
                <h2>Map View</h2>
                <div class="map-container" aria-label="Map of attractions">
                    <img src="../public/images/map.png" alt="Map of attractions" class="map-image">
                </div>
            </div>
        </section>
    </main>
    <?php require_once __DIR__ . '/Footer.php'; ?>
</body>
</html>
