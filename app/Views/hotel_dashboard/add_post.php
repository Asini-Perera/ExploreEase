<link rel="stylesheet" href="../public/css/restaurant_dashboard/add_post.css">

<h1>Add New Post</h1>

<div class="form-content">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="../hotel/addPost" method="POST" enctype="multipart/form-data">        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter post title" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Enter post description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Post Image</label>
            <input type="file" id="image" name="postImage" accept="image/*" required>
        </div>
        
        <button type="submit">Add Post</button>
        <button type="button" onclick="window.history.back()">Cancel</button>
    </form>
</div>