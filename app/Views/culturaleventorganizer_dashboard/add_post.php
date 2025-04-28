<link rel="stylesheet" href="../public/css/culturalevent_dashboard/add_post.css">

<div class="menu-container">
    <h1>Add New Post</h1>

    <?php if (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger">
            <?= $_SESSION['error'] ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <div class="form-content">
        <form action="../culturaleventorganizer/addPost" method="POST" enctype="multipart/form-data">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" id="description" required></textarea>
            </div>

            <div class="form-group">
                <label for="postImage">Post Image:</label>
                <input type="file" name="postImage" id="postImage" accept="image/*" required>
            </div>

            <div class="button-group">
                <button type="button" onclick="window.location.href='?page=post'">Cancel</button>
                <button type="submit">Add</button>
            </div>
        </form>
    </div>
</div>
