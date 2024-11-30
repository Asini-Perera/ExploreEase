<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="public/css/search_location.css">
    <title>search by location</title>

</head>
<body >
    <section class="search-header" >
        <!-- <div class="navigation" style="box-sizing: border-box; background-color: rgba(225, 225, 225, 0.5); border-radius: 10px; cursor: pointer;  width: 50px; height: 40px; margin: 30px;">
           <img src="../../public/images/back.png" style="width: 40px; padding-left: 3px;">
        </div> -->

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
     
        <div class="content" style="display:flex; gap:4rem; margin-top: 10vh;">
            <div class="map">
                <img src="../public/images/google-map.jpg" alt="map" style="cursor:pointer; width:20vw; height:35vh; margin-left: 3vw; border: #000000 1px solid;">

                <div class="filter">

                </div>
            </div>

            <div id="results" ></div>
        </div>
    </section>

   

    <script src="public/js/search_by_location/autocomplete.js"></script>
    <script src="public/js/search_by_location/result.js">
       
    </script>

</body>
</html>