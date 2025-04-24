<link rel="stylesheet" href="../public/css/culturalevent_dashboard/add_event.css">

<div class="form-content">
    <h1>Add New Event</h1>
    
    <form method="post" action="../culturaleventorganizer/addEvent" enctype="multipart/form-data">
        <div class="form-group">
            <label for="title">Event Name:</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter Name" required>
        </div>
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control" placeholder="Address" required>
        </div>
        <div class="form-group">
            <label for="date">Event Date:</label>
            <input type="date" name="date" id="date" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" id="start_time" class="form-control" placeholder="Enter start time" required>
        </div>
        <div class="form-group">
            <label for="end_time">End Time:</label>
            <input type="time" name="end_time" id="end_time" class="form-control" placeholder="Enter end time" required>
        </div>
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter Description" required></textarea>
        </div>
        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <input type="number" name="capacity" id="capacity" class="form-control" placeholder="Enter capacity" required>
        </div>
        <div class="form-group">
            <label for="price">Ticket Price:</label>
            <input type="number" name="price" id="price" class="form-control" placeholder="Enter price" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="status">Status:</label>
            <select name="status" id="status" class="form-control" required>
                <option value="">Select status</option>
                <option value="upcoming">Upcoming</option>
                <option value="ongoing">Ongoing</option>
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
