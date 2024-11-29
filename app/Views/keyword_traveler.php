<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Keywords</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/keyword.css">
</head>

<body>
    <h2>Add Keywords</h2>
    <p>select keywords according to your preferences</p>

    <form action="keywords.php">
        <label for="travel">Travel</label><br>
        <input type="checkbox" id="beach" name="travel" value="Adventure" title="Adventure"> Adventure<br>
        <input type="checkbox" id="mountain" name="travel" value="Culture" title="Culture"> Culture<br>
        <input type="checkbox" id="desert" name="travel" value="Destinations" title="Destinations"> Destinations<br>
        <input type="checkbox" id="forest" name="travel" value="Itineraries" title="Itineraries"> Itineraries<br>
        <input type="checkbox" id="city" name="travel" value="Travel Tips" title="Travel Tips"> Travel Tips<br><br>

        <label for="accommodation">Accommodation</label><br>
        <input type="checkbox" id="hotels" name="accommodation" value="Hotels" title="Hotels"> Hotels<br>
        <input type="checkbox" id="hostels" name="accommodation" value="Hostels" title="Hostels"> Hostels<br>
        <input type="checkbox" id="vacationrentals" name="accommodation" value="Vacation Rentals" title="Vacation Rentals"> Vacation Rentals<br>
        <input type="checkbox" id="camping" name="accommodation" value="Camping" title="Camping"> Camping<br>
        <input type="checkbox" id="luxurystays" name="accommodation" value="Luxury Stays" title="Luxury Stays"> Luxury Stays<br><br>

        <label for="transport">Transportation</label><br>
        <input type="checkbox" id="airplane" name="transport" value="Airplane" title="Airplane"> Airplane<br>
        <input type="checkbox" id="train" name="transport" value="Train" title="Train"> Trains<br>
        <input type="checkbox" id="carrentals" name="transport" value="Car Rentals" title="Car Rentals"> Car Rentals<br>
        <input type="checkbox" id="publictransit" name="transport" value="Public Transit" title="Public Transit"> Public Transit<br>
        <input type="checkbox" id="Bikerentals" name="transport" value="Bike Rentals" title="Bike Rentals"> Bike Rentals<br><br>

        <label for="food">Food & Drink</label><br>
        <input type="checkbox" id="localcuisine" name="food" value="Local cuisine" title="Local cuisine"> Local cuisine<br>
        <input type="checkbox" id="restuarants" name="food" value="Restuarants" title="Restuarants"> Restuarants<br>
        <input type="checkbox" id="streetfoods" name="food" value="Street Foods" title="Street Foods"> Street Foods<br>
        <input type="checkbox" id="bars" name="food" value="Bars" title="Bars"> Bars<br>
        <input type="checkbox" id="cafes" name="food" value="Cafes" title="Cafes"> Cafes<br><br>

        <label for="activities">Activities</label><br>
        <input type="checkbox" id="hiking" name="activities" value="Hiking" title="Hiking"> Hiking<br>
        <input type="checkbox" id="watersports" name="activities" value="Water Sports" title="Water Sports"> Water Sports<br>
        <input type="checkbox" id="citytours" name="activities" value="City Tours" title="City Tours"> City Tours<br>
        <input type="checkbox" id="museums" name="activities" value="Museums" title="Museums"> Museums<br>
        <input type="checkbox" id="nightlife" name="activities" value="Nightlife" title="Nightlife"> Nightlife<br><br>

        <button type="submit" formaction="">Save</button>

    </form>
</body>

</html>