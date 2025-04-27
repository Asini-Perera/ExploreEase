<link rel="stylesheet" href="../public/css/hotel_dashboard/edit_room.css">

<div class="edit-room-card">
    <h2>Edit Room</h2>
    <form action="../hotel/updateRoom" method="POST" enctype="multipart/form-data" id="edit-room-form">
        <!-- Add hidden input for room ID -->
        <input type="hidden" name="roomID" value="<?php echo isset($_SESSION['RoomID']) ? $_SESSION['RoomID'] : ''; ?>">
        
        <div class="form-group">
            <label for="roomType">Room Type</label>
            <input type="text" id="roomType" name="room_type" placeholder="Enter room type" value="<?php echo isset($_SESSION['RoomType']) ? $_SESSION['RoomType'] : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" placeholder="Enter price" value="<?php echo isset($_SESSION['Price']) ? $_SESSION['Price'] : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" id="capacity" name="capacity" placeholder="Enter capacity" value="<?php echo isset($_SESSION['Capacity']) ? $_SESSION['Capacity'] : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Enter description" required><?php echo isset($_SESSION['Description']) ? $_SESSION['Description'] : ''; ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="roomImage">Room Image</label>
            <?php if (isset($_SESSION['ImgPath']) && !empty($_SESSION['ImgPath'])): ?>
                <img src="<?php echo htmlspecialchars($_SESSION['ImgPath']); ?>" alt="Current Room Image" class="current-room-image">
            <?php else: ?>
                <img src="../public/images/default-room.png" alt="No Image Available" class="current-room-image">
            <?php endif; ?>
            <input type="file" id="roomImage" name="roomImage" accept="image/*">
            <small><i>*Leave if you don't want to change the image</i></small>
        </div>
        
        <div class="form-actions">
            <button type="sbutton" class="btn save-btn">Save Changes</button>
            <button type="button" class="btn discard-btn" onclick="window.history.back()">Discard</button>
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
    const saveButton = document.querySelector('.btn save-btn');
    const form = document.getElementById('edit-room-form');

    saveButton.addEventListener('click', () => {
        dialog.showModal(); // Show the confirmation dialog
    });

    confirmButton.addEventListener('click', () => {
        dialog.close();
        form.submit(); // Submit the form when "Yes" is clicked
    });

    cancelButton.addEventListener('click', () => {
        dialog.close(); // Close the dialog on "No"
        window.location.href = 'http://localhost/ExploreEase/hotel/dashboard?page=room'; // Redirect without saving
    });
</script>

