<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="../public/css/search_by_location.css">
    <link rel="stylesheet" href="../public/css/logedFooter.css?v=1">
    <title>search by location</title>

</head>
<body>
    <?php require_once __DIR__ . '/loggedNavbar.php'; ?>
    <section class="search-header" >

        <div class="search" style=" justify-items: center; ">
            <input type="search"  id="search-bar" placeholder="Search city for Services " autocomplete="off" style=" text-align: center; margin-top: 30vh; width: 35vw; height: 5vh; font-size: 18px; border-radius: 30px;">

            <div class="result-box">
                
            </div>

            <div class="services">
            <button class="hotel" onclick="searchServices('hotel')">Hotel</button>
            <button class="restaurant"  onclick="searchServices('restaurant')">Restaurant</button>
            <button class="heritage" onclick="searchServices('heritage_market')">Heritage Market</button>
            <button class="event" onclick="searchServices('cultural_event')">Cultural Event</button>
            </div>

           
        </div>
     
        <div class="content">
            <div class="map">
                <img src="../public/images/google-map.jpg" alt="map">

                <div class="filter">

                </div>
            </div>

            <div id="results" ></div>
        </div>
    </section>
    <?php require_once __DIR__ . '/logedFooter.php'; ?>
   

    <script src="../public/js/search_by_location/autocomplete.js"></script>
    <script src="../public/js/search_by_location/result.js">
       
    </script>

</body>
</html>