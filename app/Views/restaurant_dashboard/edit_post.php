<link rel="stylesheet" href="../public/css/restaurant_dashboard/edit_post.css">

<div class="form-content">
    <h1>Edit Post</h1>
    
    <form id="updateForm" method="POST" action="../restaurant/editPost" enctype="multipart/form-data">
        <input type="hidden" name="postID" value="<?php echo isset($postItem['PostID']) ? $postItem['PostID'] : ''; ?>">

        <div class="form-group">
            <input type="text" name="title" id="title" class="form-control"  placeholder="Enter post title" value="<?= htmlspecialchars($postItem['Title']) ?>"  required>
        </div>

        <div class="form-group">
            <textarea id="description" name="description" cols="60" rows="40" class="form-control" placeholder="Enter description"  required>  <?= htmlspecialchars($postItem['Description']) ?> </textarea>
        </div>
        
        <div class="form-group">
            <input type="file" name="image" id="image" class="form-control" value="">
        </div>

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="button"  class="save-btn" >Save</button>     
        </div>

    </form>
</div>

<dialog id="openDialog">
    <p>Are you sure do you want to edit details?</p>
    <div class="dialog-buttons">
        <button id="confirm" class="confirm-btn">Yes</button>
        <button id="cancel" class="cancel-btn">No</button>
    </div>
</dialog>


<script>
    const dialog = document.getElementById('openDialog');
    const confirmButton = document.getElementById('confirm');
    const cancelButton = document.getElementById('cancel');
    const saveButton = document.querySelector('.save-btn');
    const form = document.getElementById('updateForm');

    saveButton.addEventListener('click', () => {
        dialog.showModal(); // Show the confirmation dialog
    });

    confirmButton.addEventListener('click', () => {
        dialog.close();
        form.submit(); // Submit the form when "Yes" is clicked
    });

    cancelButton.addEventListener('click', () => {
        dialog.close(); // Close the dialog on "No"
        window.location.href = 'http://localhost/ExploreEase/restaurant/dashboard?page=post'; // Redirect without saving
    });
</script>