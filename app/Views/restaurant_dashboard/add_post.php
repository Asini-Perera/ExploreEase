<link rel="stylesheet" href="../public/css/restaurant_dashboard/add_post.css">

<div class="form-content">
    <h1>Add New Post</h1>
    
    <form method="post" action="../restaurant/addPost" enctype="multipart/form-data" id="updateForm">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter title" required>
        </div>

        <div class="form-group">
            <label for="price">Description:</label>
            <textarea id="description" name="description" cols="60" rows="40" class="form-control" placeholder="Enter Description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="post-image" id="image" class="form-control">
        </div>

        <button type="button" name="add_post" class="post_btn">Add Post</button>

        <dialog id="openDialog">
            <p>Are you sure you want to add this post?</p>
            <div class="dialog-buttons">
                <button id="confirm" class="confirm-btn">Yes</button>
                <button id="cancel" class="cancel-btn">No</button>
            </div>
        </dialog>

    </form>
</div>

<script>
    const dialog = document.getElementById('openDialog');
    const confirmButton = document.getElementById('confirm');
    const cancelButton = document.getElementById('cancel');
    const saveButton = document.querySelector('.post_btn');
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