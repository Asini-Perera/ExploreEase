<link rel="stylesheet" href="../public/css/hotel_dashboard/add_room.css">

<h1>Add New Room</h1>

<div class="form-content">
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?= $_SESSION['error']; ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <form action="../hotel/addRoom" method="POST" enctype="multipart/form-data">        
        <div class="form-group">
            <label for="room_type">Room Type</label>
            <input type="text" id="room_type" name="room_type" placeholder="Enter room type" required>
        </div>
        
        <div class="form-group">
            <label for="price">Price</label>
            <input type="number" id="price" name="price" placeholder="Enter price" required>
        </div>
        
        <div class="form-group">
            <label for="capacity">Capacity</label>
            <input type="number" id="capacity" name="capacity" placeholder="Enter capacity" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Enter description" required></textarea>
        </div>
        
        <div class="form-group">
            <label for="image">Room Image</label>
            <input type="file" id="image" name="roomImage" accept="image/*" required>
        </div>
        
        <button type="submit">Add Room</button>
        <button type="button" onclick="window.history.back()">Cancel</button>
    </form>
</div>
