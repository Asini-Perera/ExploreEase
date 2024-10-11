<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/keyword.css">
</head>
<body>
    <h2>Signup Form</h2>
    <p>select keywords according to your preferences</p>

    <form action="keywords.php">
        <h3>For Service Providers</h3>
        <label for="accommodation">1.What type of accommodation do you serve?</label><br>
        <input type="checkbox" id="hotel2" name="accommodation" value="Hotel" title="Hotel"> Hotel<br>
        <input type="checkbox" id="cabana2" name="accommodation" value="Cabana" title="Cabana"> Cabana<br>
        <input type="checkbox" id="apartment2" name="accommodation" value="Apartment Rentals" title="Apartment Rentals"> Apartment Rentals<br>
        <input type="checkbox" id="resort2" name="accommodation" value="Resort" title="Resort"> Resort<br><br>

        <label for="cuisine-types">2.What types of cuisine does your hotel/restaurant serve?</label><br>
        <input type="checkbox" id="italian2" name="cuisine_types" value="Italian" title="Italian"> Italian<br>
        <input type="checkbox" id="french2" name="cuisine_types" value="French" title="French"> French<br>
        <input type="checkbox" id="chinese2" name="cuisine_types" value="Chinese" title="Chinese"> Chinese<br>
        <input type="checkbox" id="indian2" name="cuisine_types" value="Indian" title="Indian"> Indian<br><br>

        <label for="cultural-event-types">3.Which types of cultural events do you organize?</label><br>
        <input type="checkbox" id="music-concerts1" name="cultural_event_types" value="Music Concerts" title="Music Concerts"> Music Concerts<br>
        <input type="checkbox" id="art-shows1" name="cultural_event_types" value="Art Shows" title="Art Shows"> Art Shows<br>
        <input type="checkbox" id="dance-performances1" name="cultural_event_types" value="Dance Performances" title="Dance Performances"> Dance Performances<br>
        <input type="checkbox" id="theater2" name="cultural_event_types" value="Theater Productions" title="Theater Productions"> Theater Productions<br><br>

        <label for="cultural-items-shops">4.Which types of cultural items do you have?</label><br>
        <input type="checkbox" id="art-galleries2" name="cultural_items_shops" value="Art Galleries" title="Art Galleries"> Art Galleries<br>
        <input type="checkbox" id="handicrafts2" name="cultural_items_shops" value="Handicraft Shops" title="Handicraft Shops"> Handicraft Shops<br>
        <input type="checkbox" id="traditional-clothing2" name="cultural_items_shops" value="Traditional Clothing Stores" title="Traditional Clothing Stores"> Traditional Clothing Stores<br>
        <input type="checkbox" id="antique-shops2" name="cultural_items_shops" value="Antique Shops" title="Antique Shops"> Antique Shops<br><br>

        <input type="submit" value="Submit">
        
    </form>
</body>
</html>