<link rel="stylesheet" href="../public/css/hotel_dashboard/add_room.css">

<div class="form-content">
    <h1>Menu Room</h1>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="title">Room Type:</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter room type">
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="Enter price">
        </div>
        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <input type="text" name="capacity" id="capacity" class="form-control" placeholder="Enter capacity">
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Enter description">
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        
        <button type="submit" id="add-menu">Add</button>


    </form>
</div>
