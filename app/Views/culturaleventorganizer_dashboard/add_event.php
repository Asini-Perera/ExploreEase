<link rel="stylesheet" href="../public/css/restaurant_dashboard/add_event.css">

<div class="form-content">
    <h1>Menu Items</h1>
    
    <form method="post" action="">
        <div class="form-group">
            <label for="title">Event Name:</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Name">
        </div>
        <div class="form-group">
            <label for="price">Address:</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address">
        </div>
        <div class="form-group">
            <label for="price">Event Date:</label>
            <input type="date" name="date" id="date" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Start Time:</label>
            <input type="text" name="start-time" id="start_time" class="form-control" placeholder="Enter start-time">
        </div>
        <div class="form-group">
            <label for="price">End Time:</label>
            <input type="text" name="end-time" id="end_time" class="form-control" placeholder="Enter end-time">
        </div>
        <div class="form-group">
            <label for="price">Description:</label>
            <input type="text" name="description" id="description" class="form-control" placeholder="Enter Description">
        </div>
        <div class="form-group">
            <label for="price">Capacity:</label>
            <input type="text" name="capacity" id="capacity" class="form-control" placeholder="Enter capacity">
        </div>
        <div class="form-group">
            <label for="price">Ticket Price:</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="Enter price">
        </div>

        <div class="form-group">
            <label for="status">Status</label>
            <select name="status" id="status" class="form-control">
                <option value="default"></option>
                <option value="upcoming">UpComing</option>
                <option value="ongoing"> Ongoing</option>
                <option value="completed">Completed</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" name="image" id="image" class="form-control">
        </div>

        <button type="submit" id="add-event">Add Event</button>


    </form>
</div>
