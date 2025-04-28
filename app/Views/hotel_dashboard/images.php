<link rel="stylesheet" href="../public/css/hotel_dashboard/images.css">

<div class="images-container">
    <div class="top">
        <h1>Images</h1> 

        <div class="action-buttons">
            <a class="add-btn" href="?page=images&action=add">Add Image</a>
        </div>
    </div>
    
    <?php if (!empty($images) && is_array($images)): ?>
        <?php foreach ($images as $image) : ?>
            
        <div class="image-card" name="image-card"  >
            <img src="<?= $image['ImgPath'] ?>" alt="<?= htmlspecialchars($image['Title']) ?>" name="rest-image">
                    
            <button class="delete-btn" data-delete-url='?page=images&action=delete&id=<?= $image['ImageID'] ?>' >Delete</button>
                    
            <dialog id="deleteDialog">
                <p>Are you sure you want to delete this image?</p>
                <div class="dialog-buttons">
                    <button id="deleteConfirm" class="confirm-btn">Yes</button>
                    <button id="deleteCancel" class="cancel-btn">No</button>
                </div>
            </dialog>

        </div>
        <?php endforeach; ?>

        <?php else: ?>
            <p>No images found.</p>
         
    <?php endif; ?>
</div>

 

<script>
    const deleteDialog = document.getElementById('deleteDialog');
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const confirmDelete = document.getElementById('deleteConfirm');
    const cancelDelete = document.getElementById('deleteCancel');

    let deleteUrl = '';

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            deleteUrl = button.getAttribute('data-delete-url');
            deleteDialog.showModal();
        });
    });

    confirmDelete.addEventListener('click', () => {
        deleteDialog.close();
        window.location.href = deleteUrl;
    });

    cancelDelete.addEventListener('click', () => {
        deleteDialog.close();
    });
</script>