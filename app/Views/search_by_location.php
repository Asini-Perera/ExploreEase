<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="../public/css/search_by_location.css">
  <title>Search by Location</title>
</head>
<body>
  <?php require_once __DIR__ . '/loggedNavbar.php'; ?>

  <section class="search-section">
  
    <div class="selectors">
      <h1>Discover Services Near You</h1>
      <select id="city-select">
        <option value="">Select City</option>
        <option value="Colombo">Colombo</option>
        <option value="Kandy">Kandy</option>
        <option value="Galle">Galle</option>
      </select>

      <div class="service-buttons">
        <button onclick="filterServices('hotel')">Hotels</button>
        <button onclick="filterServices('restaurant')">Restaurants</button>
        <button onclick="filterServices('heritage_market')">Heritage Markets</button>
        <button onclick="filterServices('cultural_event')">Cultural Events</button>
      </div>
    </div>

    <div id="results" class="results"></div>
    <div id="results" class="results"></div>
    
  </section>

  <?php require_once __DIR__ . '/logedFooter.php'; ?>

  <script src="../public/js/search_by_location/simple_search.js"></script>
</body>
</html>
