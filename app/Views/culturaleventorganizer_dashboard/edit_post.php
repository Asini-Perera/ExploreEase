<?php
// Get the post ID from the URL
$postID = isset($_GET['id']) ? $_GET['id'] : 0;

// If no post ID is provided, redirect back to the posts list
if (!$postID) {
    header('Location: ?page=post');
    exit;
}

// Get post data
$postModel = new \app\Models\CulturalEventOrganizerModel($this->conn);
$organizerID = $_SESSION['OrganizerID'];
$postData = $postModel->getPost($organizerID, $postID);

// Check if post exists and belongs to this organizer
if (empty($postData)) {
    header('Location: ?page=post');
    exit;
}

// Store post data for easier access
$post = $postData;
?>

<link rel="stylesheet" href="../public/css/culturalevent_dashboard/add_post.css">

<div class="form-content">
    <h1>Edit Post</h1>
    
    <form method="post" action="../culturaleventorganizer/updatePost" enctype="multipart/form-data">
        <input type="hidden" name="post_id" value="<?= htmlspecialchars($post['PostID']) ?>">
        
        <div class="form-group">
            <label for="title">Post Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($post['Title']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" required><?= htmlspecialchars($post['Description']) ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Current Image:</label>
            <?php if (!empty($post['ImgPath'])): ?>
                <div class="image-preview">
                    <img src="<?= htmlspecialchars($post['ImgPath']) ?>" alt="Post Image">
                </div>
            <?php else: ?>
                <p>No image available</p>
            <?php endif; ?>
            <input type="file" name="postImage" id="image" class="form-control">
        </div>
        
        <button type="submit" class="btn btn-primary">Update Post</button>
    </form>
</div>
