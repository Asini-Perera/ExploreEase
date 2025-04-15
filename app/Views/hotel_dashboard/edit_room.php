<link rel="stylesheet" href="../public/css/hotel_dashboard/edit_room.css">

<div class="edit-room-card">
    <h2>Edit Room</h2>
    <form action="../hotel/editRoom" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="roomID" value="<?php echo $_SESSION['RoomID']; ?>">
        <div class="form-group">
            <label for="roomType">Room Type:</label>
            <input type="text" id="roomType" name="room_type" value="<?php echo $_SESSION['RoomType'] ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" id="price" name="price" value="<?php echo $_SESSION['Price'] ?>" required>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <input type="number" id="capacity" name="capacity" value="<?php echo $_SESSION['Capacity'] ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea id="description" name="description" required><?php echo $_SESSION['Description'] ?></textarea>    
        </div>
        <div class="form-group">
            <label for="roomImage">Room Image:</label>
            <img src="<?= $room['ImgPath'] ?>" alt="Current Room Image" class="room-img-preview">
            <input type="file" id="roomImage" name="roomImage" accept="image/*">
        </div>
        <div class="form-actions">
            <button type="submit" class="btn">Save Changes</button>
            <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancel</button>
        </div>
    </form>
</div>