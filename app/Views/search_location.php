<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>search by location</title>

    <style>
        button{
            width:16vw; 
            font-size: 23px;
            height: 6vh;
            cursor: pointer;
           background-color: rgba(225, 225, 225, 0.2);
            color: #000000;
            /* margin: 60px; */
            border: none;
            
        }

        
    </style>
</head>
<body style="background:url(../../public/images/9.jpg) no-repeat ; background-size: 100% 100vh; margin: 0;">
    <section class="search-header" >
        <div class="navigation" style="box-sizing: border-box; background-color: rgba(225, 225, 225, 0.5); border-radius: 10px; cursor: pointer;  width: 50px; height: 40px; margin: 30px;">
           <img src="../../public/images/back.png" style="width: 40px; padding-left: 3px;">
        </div>

        <div class="search" style=" justify-items: center; ">
            <input type="search" id="search" placeholder="Enter District " style="margin-top: 32vh; width: 35vw; height: 5vh; font-size: 24px;">

            <div class="services" style="padding: 10px; margin-top: 34vh; background-color: rgb(225, 225, 225 ); width: 65vw; border-radius: 50px;">
                <button ><a link="#hotel">Hotels</a></button>
                <button ><a link="#restaurant">Restaurants</a></button>
                <button ><a link="#heritage-market">Heritage Market</a></button>
                <button ><a link="#cultural-event">Cultural Events</a></button>
            </div>
        </div>
    </section>

<!-- hotels -->
    <section class="hotel" id="hotel" style="margin-top: 17vh;">
        <div class="title" style="margin-left: 50px; font-size: 24px; ">
            <h2>Hotels</h2> 
        </div>

        <div class="hotel-details" style="display: flex; margin-left: 50px; padding: 20px; background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img" >
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="hotel-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px;  background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="hotel-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px;  background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="load-more" style="margin-left: 45vw;">
            <button style="width: 10vw; background-color: #225522; height: 4vh; margin-top: 2vh; color: #ffffff;">Load More</button>
        </div>
    </section>


<!-- restaurants -->
    <section class="restaurant" id="restaurant">
        <div class="title"  style="margin-left: 50px; font-size: 24px; ">
           <h2>Restaurant</h2> 
        </div>

        <div class="restaurant-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px;  background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="restaurant-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px;  background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="restaurant-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px;  background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="load-more" style="margin-left: 45vw;">
            <button style="width: 10vw; background-color: #225522; height: 4vh; margin-top: 2vh; color: #ffffff;">Load More</button>
        </div>
    </section>


<!-- heritage market -->
    <section class="heritage-market" id="heritage-market">
        <div class="title"  style="margin-left: 50px; font-size: 24px; ">
            <h2>Heritage-Market</h2> 
        </div>

        <div class="heritage-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px; background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="heritage-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px;  background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="heritage-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px;  background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="load-more" style="margin-left: 45vw;">
            <button style="width: 10vw; background-color: #225522; height: 4vh; margin-top: 2vh; color: #ffffff;">Load More</button>
        </div>

    </section>


<!-- cultural events -->
    <section class="cultural-event" id="cultural-event" style="margin-bottom: 50px;">
        <div class="title"  style="margin-left: 50px; font-size: 24px; ">
            <h2>Cultural Events</h2> 
        </div>

        <div class="event-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px;  background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="event-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px;  background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="event-details" style="display: flex; margin-top:30px; display: flex; margin-left: 50px; padding: 20px;  background-color:#D9D9D9; height: 20vh; width: 90vw;">
            <div class="hotel-img">
                <img src="../../public/images/2.jpg" alt="hotel" style="height: 20vh; width: 16vw;" >
            </div>

            <div class="hotel-info" style="margin-left:2vw ;">
                <h3>hotel name</h3>
                <p>location</p>
                <p>contact</p>
                <p>rating</p>
            </div>
        </div>

        <div class="load-more" style="margin-left: 45vw;">
            <button style="width: 10vw; background-color: #225522; height: 4vh; margin-top: 2vh; color: #ffffff;">Load More</button>
        </div>

    </section>

</body>
</html>