<link rel="stylesheet" href="../public/css/hotel_dashboard/edit_post.css">

<!-- <?php if (isset($_SESSION['error'])): ?>
    <div class="error-message">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?> -->

<div class="edit-post-card">
    <h2>Edit Post</h2>
    <form action="../hotel/updatePost" method="POST" enctype="multipart/form-data">
        <!-- Add hidden input for post ID -->
        <input type="hidden" name="postID" value="<?php echo isset($_SESSION['PostID']) ? $_SESSION['PostID'] : ''; ?>">
        
        <div class="form-group">
            <label for="title">Title</label>
            <input type="text" id="title" name="title" placeholder="Enter post title" value="<?php echo isset($_SESSION['Title']) ? $_SESSION['Title'] : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Enter post description" required><?php echo isset($_SESSION['Description']) ? $_SESSION['Description'] : ''; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Post Image</label>
            <?php if (isset($_SESSION['ImgPath']) && !empty($_SESSION['ImgPath'])): ?>
                <img src="<?php echo htmlspecialchars($_SESSION['ImgPath']); ?>" alt="Current Post Image" class="current-post-image">
            <?php else: ?>
                <img src="../public/images/default-post.png" alt="No Image Available" class="current-post-image">
            <?php endif; ?>
            <input type="file" id="image" name="postImage" accept="image/*">
            <small><i>*Leave if you don't want to change the image</i></small>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn save-btn">Save Changes</button>
            <button type="button" class="btn discard-btn" onclick="window.history.back()">Discard</button>
        </div>
    </form>
</div>