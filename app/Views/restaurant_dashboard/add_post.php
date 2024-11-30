<link rel="stylesheet" href="../public/css/restaurant_dashboard/add_post.css">

<div class="form-content">
    <h1>Add New Post</h1>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter food name" required>
        </div>

        <div class="form-group">
            <label for="price">Description:</label>
            <textarea id="description" cols="60" rows="40" class="form-control" placeholder="Enter price" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" name="add_manu" class="menu_btn">Add Post</button>


    </form>
</div>
