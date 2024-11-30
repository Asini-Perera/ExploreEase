<link rel="stylesheet" href="../public/css/restaurant_dashboard/edit_post.css">

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

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="">Discard</button>
            <button type="submit" class="save-btn" onclick="">Save</button>     
        </div>

    </form>
</div>