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
                <option value="appetizer">Appetizer</option>
                <option value="main_course" selected>Main Course</option>
                <option value="dessert">Dessert</option>
                <option value="beverage">Beverage</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" id="add-menu">Add</button>


    </form>
</div>
