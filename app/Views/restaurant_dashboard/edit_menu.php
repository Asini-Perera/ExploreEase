<link rel="stylesheet" href="../public/css/restaurant_dashboard/edit_menu.css">

<div class="form-content">
    <h1>Edit Menu</h1>
    
    <form method="POST" action="../restaurant/editMenu" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Food Name:</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter food name"  value="<?= htmlspecialchars($menuItem['FoodName']) ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="Enter price" value="<?= htmlspecialchars($menuItem['Price']) ?>" required>
        </div>
        <div class="form-group">
            <label for="category">Food Category:</label>
            <select name="category" id="category" class="form-control"  value="<?= htmlspecialchars($menuItem['FoodCategory']) ?>" required>
                <option value="default" <?= $menuItem['FoodCategory'] == 'default' ? 'selected' : '' ?>></option>
                <option value="Breakfast" <?= $menuItem['FoodCategory'] == 'Breakfast' ? 'selected' : '' ?>>Breakfast</option>
                <option value="Lunch" <?= $menuItem['FoodCategory'] == 'Lunch' ? 'selected' : '' ?>>Lunch</option>
                <option value="Tea-time" <?= $menuItem['FoodCategory'] == 'Tea-time' ? 'selected' : '' ?>>Tea-time</option>
                <option value="Dinner" <?= $menuItem['FoodCategory'] == 'Dinner' ? 'selected' : '' ?>>Dinner</option>
                <option value="Drinks" <?= $menuItem['FoodCategory'] == 'Drinks' ? 'selected' : '' ?>>Drinks</option>
            </select>
        </div>

        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <div>
            <label for="popular-dish" class="popular-dish" >Is this popular dish</label>
            <input type="radio" name="popular-dish" class="popular_food" value="1" <?= $menuItem['IsPopular'] == 1 ? 'checked' : '' ?>> Yes
            <input type="radio" name="popular-dish" class="not_popular" value="0" <?= $menuItem['IsPopular'] == 0 ? 'checked' : '' ?>> No
        </div>

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="submit" class="save-btn" onclick="">Save</button>     
        </div>


    </form>
</div>