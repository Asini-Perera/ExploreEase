<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu</title>

    <style>
        * {
            padding: 0;
            margin: 0;
            box-sizing: border-box;
            font-family: "Poppins", sans-serif;
        }

        body {
            background: url('../../public/images/menu-back.jpg') no-repeat center center/cover;
            /* background-color: #f8f9fa; */
            color: #333;
            height: 100%;
        }

        .menu-container {
            width: 90%;
            margin: 20px auto;
            text-align: center;
        }

        .menu-header {
            font-size: 32px;
            font-weight: bold;
            color: #F1C232;
            font-size: 5rem;
            padding-bottom: 2vh; 
            font-family: Edwardian Script ITC;
        }


        .main-card {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 10px;
        }

        .card {
            flex: 1 1 calc(48% - 10px);
            min-width: 450px;
            padding: 15px;
            background-color: rgba(255,255,255,0.5);
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            border-radius: 8px;
            transition: transform 0.3s ease, box-shadow 0.3s ease;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        h3 {
            font-size: 24px;
            margin: 2vh 0;
            color: #225522;
        }

        .dish {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
            align-items: center;
            font-size: 18px;
            font-weight: bold;
            color: #000000;
        }

        .price {
            font-weight: bold;
            color: #000000;
        }


        .fade-image{
            width: 100px;
            height: 100%;
            object-fit: cover;
            border-radius: 8px;
            opacity: 0.5;
        }

        @media (max-width: 768px) {
            .main-card {
                flex-direction: column;
                gap: 20px;
            }
        }
    </style>
</head>
<body>
    <div class="menu-container">
        <div class="main-card">
            <img src="../../public/images/food-1.png" class="fade-image">
            <h1 class="menu-header">Menu</h1>
            <img src="../../public/images/food-1.png" class="fade-image">
        </div>
            
      

        <div class="main-card">
            <!-- Card 1 -->
            <div class="card">

                <h3>Soups</h3>
                <div class="dish">
                    <span class="name">Vegetable Soup</span>
                    <span class="price">LKR 494.00</span>
                </div>
                <div class="dish">
                    <span class="name">Cream of Chicken Soup</span>
                    <span class="price">LKR 794.00</span>
                </div>
                <div class="dish">
                    <span class="name">Egg Soup</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Fish Soup</span>
                    <span class="price">LKR 754.00</span>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="card">
                <h3>Salads</h3>
                <div class="dish">
                    <span class="name">Mixed Vegetable Salad</span>
                    <span class="price">LKR 854.00</span>
                </div>
                <div class="dish">
                    <span class="name">Tomato Cucumber Salad</span>
                    <span class="price">LKR 754.00</span>
                </div>
                <div class="dish">
                    <span class="name">Coleslaw Salad</span>
                    <span class="price">LKR 715.00</span>
                </div>
                <div class="dish">
                    <span class="name">Potato Salad</span>
                    <span class="price">LKR 585.00</span>
                </div>
            </div>

            <!-- Card 3 -->
            <div class="card">
                <h3>Devilled</h3>
                <div class="dish">
                    <span class="name">Devilled Chicken</span>
                    <span class="price">LKR 494.00</span>
                </div>
                <div class="dish">
                    <span class="name">Devilled Cuttlefish</span>
                    <span class="price">LKR 794.00</span>
                </div>
                <div class="dish">
                    <span class="name">Devilled Fish</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Devilled Crab</span>
                    <span class="price">LKR 715.00</span>
                </div>
            </div>

            <!-- Card 4 -->
            <div class="card">
                <h3>Macaroni</h3>
                <div class="dish">
                    <span class="name">Macaroni with Garlic White Sauce</span>
                    <span class="price">LKR 1,190.00</span>
                </div>
                <div class="dish">
                    <span class="name">Macaroni with Prawns</span>
                    <span class="price">LKR 1780.00</span>
                </div>
                <div class="dish">
                    <span class="name">Macaroni with SeaFood</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Macaroni with Chicken</span>
                    <span class="price">LKR 650.00</span>
                </div>
                <div class="dish">
                    <span class="name">Macaroni with Mushroom Cream Sauce</span>
                    <span class="price">LKR 980.00</span>
                </div>
                
            </div>

             <!-- Card 5 -->
             <div class="card">
                <h3>Devilled</h3>
                <div class="dish">
                    <span class="name">Devilled Chicken</span>
                    <span class="price">LKR 494.00</span>
                </div>
                <div class="dish">
                    <span class="name">Devilled Cuttlefish</span>
                    <span class="price">LKR 794.00</span>
                </div>
                <div class="dish">
                    <span class="name">Devilled Fish</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Devilled Crab</span>
                    <span class="price">LKR 715.00</span>
                </div>
            </div>

             <!-- Card 6 -->
             <div class="card">
                <h3>Noodles</h3>
                <div class="dish">
                    <span class="name">Mixed Noodles</span>
                    <span class="price">LKR 854.00</span>
                </div>
                <div class="dish">
                    <span class="name">Egg Noodles</span>
                    <span class="price">LKR 754.00</span>
                </div>
                <div class="dish">
                    <span class="name">Veg Noodles</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Seafood Noodles</span>
                    <span class="price">LKR 494.00</span>
                </div>
                <div class="dish">
                    <span class="name">Prawns Noodles</span>
                    <span class="price">LKR 494.00</span>
                </div>
                <div class="dish">
                    <span class="name">Fish Noodles</span>
                    <span class="price">LKR 910.00</span>
                </div>
            </div>


             <!-- Card 7 -->
             <div class="card">
                <h3>Noodles</h3>
                <div class="dish">
                    <span class="name">Mixed Noodles</span>
                    <span class="price">LKR 854.00</span>
                </div>
                <div class="dish">
                    <span class="name">Egg Noodles</span>
                    <span class="price">LKR 754.00</span>
                </div>
                <div class="dish">
                    <span class="name">Veg Noodles</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Seafood Noodles</span>
                    <span class="price">LKR 494.00</span>
                </div>
            </div>

             <!-- Card 8 -->
             <div class="card">
                <h3>Noodles</h3>
                <div class="dish">
                    <span class="name">Mixed Noodles</span>
                    <span class="price">LKR 854.00</span>
                </div>
                <div class="dish">
                    <span class="name">Egg Noodles</span>
                    <span class="price">LKR 754.00</span>
                </div>
                <div class="dish">
                    <span class="name">Veg Noodles</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Seafood Noodles</span>
                    <span class="price">LKR 494.00</span>
                </div>
            </div>

             <!-- Card 9 -->
             <div class="card">
                <h3>Noodles</h3>
                <div class="dish">
                    <span class="name">Mixed Noodles</span>
                    <span class="price">LKR 854.00</span>
                </div>
                <div class="dish">
                    <span class="name">Egg Noodles</span>
                    <span class="price">LKR 754.00</span>
                </div>
                <div class="dish">
                    <span class="name">Veg Noodles</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Seafood Noodles</span>
                    <span class="price">LKR 494.00</span>
                </div>
            </div>

             <!-- Card 10 -->
            <div class="card">
                <h3>Noodles</h3>
                <div class="dish">
                    <span class="name">Mixed Noodles</span>
                    <span class="price">LKR 854.00</span>
                </div>
                <div class="dish">
                    <span class="name">Egg Noodles</span>
                    <span class="price">LKR 754.00</span>
                </div>
                <div class="dish">
                    <span class="name">Veg Noodles</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Seafood Noodles</span>
                    <span class="price">LKR 494.00</span>
                </div>
            </div>

            <!-- Card 11 -->
            <div class="card">
                <h3>Noodles</h3>
                <div class="dish">
                    <span class="name">Mixed Noodles</span>
                    <span class="price">LKR 854.00</span>
                </div>
                <div class="dish">
                    <span class="name">Egg Noodles</span>
                    <span class="price">LKR 754.00</span>
                </div>
                <div class="dish">
                    <span class="name">Veg Noodles</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Seafood Noodles</span>
                    <span class="price">LKR 494.00</span>
                </div>
            </div>

            <!-- Card 12 -->
            <div class="card">
                <h3>Noodles</h3>
                <div class="dish">
                    <span class="name">Mixed Noodles</span>
                    <span class="price">LKR 854.00</span>
                </div>
                <div class="dish">
                    <span class="name">Egg Noodles</span>
                    <span class="price">LKR 754.00</span>
                </div>
                <div class="dish">
                    <span class="name">Veg Noodles</span>
                    <span class="price">LKR 585.00</span>
                </div>
                <div class="dish">
                    <span class="name">Seafood Noodles</span>
                    <span class="price">LKR 494.00</span>
                </div>
            </div>

            <div class="main-card">
                <img src="../../public/images/food-1.png" class="fade-image">
                <img src="../../public/images/food-1.png" class="fade-image">
            </div>

        </div>
    </div>
</body>
</html>
