<link rel="stylesheet" href="../public/css/hotel_dashboard/edit_room.css">

<div class="edit-room-card">
    <h2>Edit Room</h2>
    <form action="../hotel/updateRoom" method="POST" >
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
        
        <!-- <div class="form-group">
            <label for="roomImage">Room Image</label>
            <img src="<?php echo isset($_SESSION['ImgPath']) ? htmlspecialchars($_SESSION['ImgPath']) : '../public/images/default-room.png'; ?>" alt="Current Room Image" class="room-img-preview">
            <input type="file" id="roomImage" name="roomImage" accept="image/*">
        </div> -->
        
        <div class="form-actions">
            <button type="submit" class="btn save-btn">Save Changes</button>
            <button type="button" class="btn discard-btn" onclick="window.history.back()">Discard</button>
        </div>
    </form>
</div>