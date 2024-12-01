<link rel="stylesheet" href="../public/css/restaurant_dashboard/add_menu.css">

<div class="form-content">
    <h1>Menu Items</h1>
    
    <form method="post" action="../restaurant/addMenu">
        <div class="form-group">
            <label for="title">Food Name:</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter food name" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="Enter price" required>
        </div>
        <div class="form-group">
            <label for="category">Food Category:</label>
            <select name="category" id="category" class="form-control">
                <option value="default"></option>
                <option value="Breakfast">Breakfast</option>
                <option value="Lunch">Lunch</option>
                <option value="Tea-time">Tea-time</option>
                <option value="Dinner">Dinner</option>
                <option value="Drinks">Drinks</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div class="form-group">
            <label for="popular-dish">Is this popular dish:</label>
            <input type="radio" name="popular-dish" class="popular_food"  value="1"> Yes
            <input type="radio" name="popular-dish" class="not_popular" value="0"> No
        </div>

        <button type="submit" name="add_manu" class="menu_btn">Add Menu</button>


    </form>
</div>
