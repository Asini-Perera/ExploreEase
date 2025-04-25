<?php
// Get the event ID from the URL
$eventID = isset($_GET['id']) ? $_GET['id'] : 0;

// If no event ID is provided, redirect back to the event list
if (!$eventID) {
    header('Location: ?page=event');
    exit;
}

// Get event data
$eventModel = new \app\Models\CulturalEventOrganizerModel($this->conn);
$eventData = $eventModel->getEvent($eventID);

// Check if event exists and belongs to this organizer
if (empty($eventData) || $eventData[0]['OrganizerID'] != $_SESSION['OrganizerID']) {
    header('Location: ?page=event');
    exit;
}

// Store event data for easier access
$event = $eventData[0];
?>

<link rel="stylesheet" href="../public/css/culturalevent_dashboard/add_event.css">

<div class="form-content">
    <h1>Edit Event</h1>
    
    <form method="post" action="../culturaleventorganizer/updateEvent" enctype="multipart/form-data">
        <input type="hidden" name="event_id" value="<?= htmlspecialchars($event['EventID']) ?>">
        
        <div class="form-group">
            <label for="title">Event Name:</label>
            <input type="text" name="title" id="title" class="form-control" value="<?= htmlspecialchars($event['Name']) ?>" placeholder="Enter Name" required>
        </div>
        
        <div class="form-group">
            <label for="address">Address:</label>
            <input type="text" name="address" id="address" class="form-control" value="<?= htmlspecialchars($event['Address']) ?>" placeholder="Address" required>
        </div>
        
        <div class="form-group">
            <label for="date">Event Date:</label>
            <input type="date" name="date" id="date" class="form-control" value="<?= htmlspecialchars($event['Date']) ?>" required>
        </div>
        
        <div class="form-group">
            <label for="start_time">Start Time:</label>
            <input type="time" name="start_time" id="start_time" class="form-control" value="<?= htmlspecialchars($event['StartTime']) ?>" placeholder="Enter start time" required>
        </div>
        
        <div class="form-group">
            <label for="end_time">End Time:</label>
            <input type="time" name="end_time" id="end_time" class="form-control" value="<?= htmlspecialchars($event['EndTime']) ?>" placeholder="Enter end time" required>
        </div>
        
        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" id="description" class="form-control" placeholder="Enter Description" required><?= htmlspecialchars($event['Description']) ?></textarea>
        </div>
        
        <div class="form-group">
            <label for="capacity">Capacity:</label>
            <input type="number" name="capacity" id="capacity" class="form-control" value="<?= htmlspecialchars($event['Capacity']) ?>" placeholder="Enter capacity" required>
        </div>
        
        <div class="form-group">
            <label for="price">Ticket Price:</label>
            <input type="number" name="price" id="price" class="form-control" value="<?= htmlspecialchars($event['TicketPrice']) ?>" placeholder="Enter price" step="0.01" required>
        </div>

        <div class="form-group" style="float: left; margin-right: 20px;">
            <label for="status">Event Status:</label>
            <select name="status" id="status" class="form-control status-select" style="width: auto; padding: 6px 12px; border-radius: 4px; font-weight: bold; text-transform: uppercase; font-size: 10px;
            <?php 
            switch(strtolower($event['Status'])) {
            case 'upcoming': echo 'background-color: #007bff; color: white;'; break;
            case 'ongoing': echo 'background-color: #28a745; color: white;'; break;
            case 'completed': echo 'background-color: #6c757d; color: white;'; break;
            default: echo 'background-color: #f8f9fa; color: #212529;';
            }
            ?>" required>
            <option value="upcoming" <?= strtolower($event['Status']) == 'upcoming' ? 'selected' : '' ?>>Upcoming</option>
            <option value="ongoing" <?= strtolower($event['Status']) == 'ongoing' ? 'selected' : '' ?>>Ongoing</option>
            <option value="completed" <?= strtolower($event['Status']) == 'completed' ? 'selected' : '' ?>>Completed</option>
            </select>
        </div>
                
        <div class="form-group">
            <label for="image">Current Image:</label>
            <?php if (!empty($event['ImgPath'])): ?>
            <div class="image-preview" style="width: 200px; height: 150px; margin-bottom: 10px; border: 1px solid #ddd; overflow: hidden;">
                <img src="<?= htmlspecialchars($event['ImgPath']) ?>" style="width: 100%; height: 100%; object-fit: cover;">
            </div>
            <?php else: ?>
            <div class="image-preview" style="width: 200px; height: 150px; margin-bottom: 10px; border: 1px solid #ddd; display: flex; align-items: center; justify-content: center; background-color: #f8f9fa;">
                <span>No image available</span>
            </div>
            <?php endif; ?>
            <input type="file" name="image" id="image" class="form-control">
        </div>
        <button type="submit" id="update-event">Update Event</button>
    </form>
</div>
