<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup Form</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/keyword.css">
</head>

<body>
    <h2>Signup Form</h2>
    <p>select keywords according to your preferences</p>

    <form action="keywords.php">
        <h3>For Travelers</h3>
        <label for="accommodation">1.What type of accommodation do you prefer?</label><br>
        <input type="checkbox" id="hotel1" name="accommodation" value="Hotel" title="Hotel"> Hotel<br>
        <input type="checkbox" id="cabana1" name="accommodation" value="Cabana" title="Cabana"> Cabana<br>
        <input type="checkbox" id="apartment1" name="accommodation" value="Apartment Rentals" title="Apartment Rentals"> Apartment Rentals<br>
        <input type="checkbox" id="resort1" name="accommodation" value="Resort" title="Resort"> Resort<br><br>

        <label for="food">2.What type of food do you prefer?</label><br>
        <input type="checkbox" id="italian1" name="food" value="Italian" title="Italian"> Italian<br>
        <input type="checkbox" id="french1" name="food" value="French" title="French"> French<br>
        <input type="checkbox" id="chinese1" name="food" value="Chinese" title="Chinese"> Chinese<br>
        <input type="checkbox" id="indian1" name="food" value="Indian" title="Indian"> Indian<br><br>

        <label for="cultural-events">3.Which types of cultural events are you interested in?</label><br>
        <input type="checkbox" id="music-festival1" name="cultural_events" value="Music Festivals" title="Music Festivals"> Music Festivals<br>
        <input type="checkbox" id="art-exhibitions1" name="cultural_events" value="Art Exhibitions" title="Art Exhibitions"> Art Exhibitions<br>
        <input type="checkbox" id="theater1" name="cultural_events" value="Theater Performances" title="Theater Performances"> Theater Performances<br>
        <input type="checkbox" id="dance-shows1" name="cultural_events" value="Dance Shows" title="Dance Shows"> Dance Shows<br><br>

        <label for="cultural-items-shops">4.What types of cultural items shops are you interested in?</label><br>
        <input type="checkbox" id="art-galleries1" name="cultural_items_shops" value="Art Galleries" title="Art Galleries"> Art Galleries<br>
        <input type="checkbox" id="handicrafts1" name="cultural_items_shops" value="Handicraft Shops" title="Handicraft Shops"> Handicraft Shops<br>
        <input type="checkbox" id="traditional-clothing1" name="cultural_items_shops" value="Traditional Clothing Stores" title="Traditional Clothing Stores"> Traditional Clothing Stores<br>
        <input type="checkbox" id="antique-shops1" name="cultural_items_shops" value="Antique Shops" title="Antique Shops"> Antique Shops<br><br>

        <input type="submit" value="Submit">

    </form>
</body>

</html>