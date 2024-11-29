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
    <div class="container">
        <div class="signup-box">
            <h2>Add Keywords</h2>
            <p>Select keywords according to your preferences</p>

            <form action="keywords.php">
                <div class="input-group">
                    <label for="travel">Travel</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" id="beach" name="travel" value="Adventure" title="Adventure"> Adventure</label>
                        <label><input type="checkbox" id="mountain" name="travel" value="Culture" title="Culture"> Culture</label>
                        <label><input type="checkbox" id="desert" name="travel" value="Destinations" title="Destinations"> Destinations</label>
                        <label><input type="checkbox" id="forest" name="travel" value="Itineraries" title="Itineraries"> Itineraries</label>
                        <label><input type="checkbox" id="city" name="travel" value="Travel Tips" title="Travel Tips"> Travel Tips</label>
                    </div>
                </div>

                <div class="input-group">
                    <label for="accommodation">Accommodation</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" id="hotels" name="accommodation" value="Hotels" title="Hotels"> Hotels</label>
                        <label><input type="checkbox" id="hostels" name="accommodation" value="Hostels" title="Hostels"> Hostels</label>
                        <label><input type="checkbox" id="vacationrentals" name="accommodation" value="Vacation Rentals" title="Vacation Rentals"> Vacation Rentals</label>
                        <label><input type="checkbox" id="camping" name="accommodation" value="Camping" title="Camping"> Camping</label>
                        <label><input type="checkbox" id="luxurystays" name="accommodation" value="Luxury Stays" title="Luxury Stays"> Luxury Stays</label>
                    </div>
                </div>

                <div class="input-group">
                    <label for="transport">Transportation</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" id="airplane" name="transport" value="Airplane" title="Airplane"> Airplane</label>
                        <label><input type="checkbox" id="train" name="transport" value="Train" title="Train"> Train</label>
                        <label><input type="checkbox" id="carrentals" name="transport" value="Car Rentals" title="Car Rentals"> Car Rentals</label>
                        <label><input type="checkbox" id="publictransit" name="transport" value="Public Transit" title="Public Transit"> Public Transit</label>
                        <label><input type="checkbox" id="bikerentals" name="transport" value="Bike Rentals" title="Bike Rentals"> Bike Rentals</label>
                    </div>
                </div>

                <div class="input-group">
                    <label for="food">Food & Drink</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" id="localcuisine" name="food" value="Local cuisine" title="Local cuisine"> Local cuisine</label>
                        <label><input type="checkbox" id="restaurants" name="food" value="Restaurants" title="Restaurants"> Restaurants</label>
                        <label><input type="checkbox" id="streetfoods" name="food" value="Street Foods" title="Street Foods"> Street Foods</label>
                        <label><input type="checkbox" id="bars" name="food" value="Bars" title="Bars"> Bars</label>
                        <label><input type="checkbox" id="cafes" name="food" value="Cafes" title="Cafes"> Cafes</label>
                    </div>
                </div>

                <div class="input-group">
                    <label for="activities">Activities</label>
                    <div class="checkbox-group">
                        <label><input type="checkbox" id="hiking" name="activities" value="Hiking" title="Hiking"> Hiking</label>
                        <label><input type="checkbox" id="watersports" name="activities" value="Water Sports" title="Water Sports"> Water Sports</label>
                        <label><input type="checkbox" id="citytours" name="activities" value="City Tours" title="City Tours"> City Tours</label>
                        <label><input type="checkbox" id="museums" name="activities" value="Museums" title="Museums"> Museums</label>
                        <label><input type="checkbox" id="nightlife" name="activities" value="Nightlife" title="Nightlife"> Nightlife</label>
                    </div>
                </div>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    <script src="../public/js/background_slideshow2.js"></script>
</body>

</html>
