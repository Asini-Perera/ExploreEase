<link rel="stylesheet" href="../public/css/culturalevent_dashboard/edit_booking.css">

<?php if (isset($_SESSION['error'])): ?>
    <div class="error-message">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="edit-booking-card">
    <h2>Edit Booking</h2>
    <form action="../culturaleventorganizer/updateBooking" method="POST">
        <!-- Add hidden input for booking ID -->
        <input type="hidden" name="bookingID" value="<?php echo isset($_SESSION['BookingID']) ? $_SESSION['BookingID'] : ''; ?>">
        
        <div class="form-group">
            <label for="date">Booking Date</label>
            <input type="date" id="date" name="date" value="<?php echo isset($_SESSION['Date']) ? $_SESSION['Date'] : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="quantity">Ticket Quantity</label>
            <input type="number" id="quantity" name="quantity" min="1" value="<?php echo isset($_SESSION['Quantity']) ? $_SESSION['Quantity'] : '1'; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="status">Status</label>
            <select id="status" name="status" required>
                <option value="Confirmed" <?php echo (isset($_SESSION['Status']) && $_SESSION['Status'] == 'Confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                <option value="Pending" <?php echo (isset($_SESSION['Status']) && $_SESSION['Status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="Cancelled" <?php echo (isset($_SESSION['Status']) && $_SESSION['Status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            </select>
        </div>

        <div class="form-group">
            <label for="eventID">Event</label>
            <select id="eventID" name="eventID" required>
                <?php 
                if (isset($_SESSION['AvailableEvents']) && !empty($_SESSION['AvailableEvents'])) {
                    foreach ($_SESSION['AvailableEvents'] as $event) {
                        $selected = ($_SESSION['EventID'] == $event['EventID']) ? 'selected' : '';
                        echo "<option value='{$event['EventID']}' {$selected}>{$event['Name']}</option>";
                    }
                } else {
                    echo "<option value='{$_SESSION['EventID']}' selected>Event {$_SESSION['EventID']}</option>";
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="travelerID">Traveler</label>
            <input type="hidden" id="travelerID" name="travelerID" value="<?php echo isset($_SESSION['TravelerID']) ? $_SESSION['TravelerID'] : ''; ?>">
            <input type="text" value="<?php echo isset($_SESSION['TravelerName']) ? $_SESSION['TravelerName'] : ''; ?>" readonly>
        </div>
        
        <div class="form-actions">
            <button type="submit" class="btn save-btn">Save Changes</button>
            <button type="button" class="btn discard-btn" onclick="window.history.back()">Discard</button>
        </div>
    </form>
</div>
