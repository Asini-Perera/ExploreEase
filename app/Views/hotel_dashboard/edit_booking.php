<link rel="stylesheet" href="../public/css/hotel_dashboard/edit_booking.css">

<?php if (isset($_SESSION['error'])): ?>
    <div class="error-message">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="edit-booking-card">
    <h2>Edit Booking</h2>
    <form action="../hotel/dashboard?action=updateBooking" method="POST" id="updateForm">
        <!-- Add hidden input for booking ID -->
        <input type="hidden" name="bookingID" value="<?php echo isset($_SESSION['BookingID']) ? $_SESSION['BookingID'] : ''; ?>">
        
        <div class="form-group">
            <label for="checkInDate">Check-In Date</label>
            <input type="date" id="checkInDate" name="checkInDate" value="<?php echo isset($_SESSION['CheckInDate']) ? $_SESSION['CheckInDate'] : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="checkOutDate">Check-Out Date</label>
            <input type="date" id="checkOutDate" name="checkOutDate" value="<?php echo isset($_SESSION['CheckOutDate']) ? $_SESSION['CheckOutDate'] : ''; ?>" required>
        </div>
        
        <div class="form-group">
            <label for="date">Booking Date</label>
            <input type="date" id="date" name="date" value="<?php echo isset($_SESSION['Date']) ? $_SESSION['Date'] : ''; ?>" required>
        </div>

        <div class="form-group">
            <label for="paymentStatus">Status</label>
            <select id="paymentStatus" name="paymentStatus" required>
                <option value="Confirmed" <?php echo (isset($_SESSION['Status']) && $_SESSION['Status'] == 'Confirmed') ? 'selected' : ''; ?>>Confirmed</option>
                <option value="Pending" <?php echo (isset($_SESSION['Status']) && $_SESSION['Status'] == 'Pending') ? 'selected' : ''; ?>>Pending</option>
                <option value="Cancelled" <?php echo (isset($_SESSION['Status']) && $_SESSION['Status'] == 'Cancelled') ? 'selected' : ''; ?>>Cancelled</option>
            </select>
        </div>

        <div class="form-group">
            <label for="roomID">Room No</label>
            <select id="roomID" name="roomID" required>
                <?php 
                if (isset($_SESSION['AvailableRooms']) && !empty($_SESSION['AvailableRooms'])) {
                    foreach ($_SESSION['AvailableRooms'] as $room) {
                        $selected = ($_SESSION['RoomID'] == $room['RoomID']) ? 'selected' : '';
                        echo "<option value='{$room['RoomID']}' {$selected}>Room {$room['RoomID']} - {$room['Type']}</option>";
                    }
                } else {
                    // Fallback if no rooms are available
                    echo "<option value='{$_SESSION['RoomID']}' selected>Room {$_SESSION['RoomID']}</option>";
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
            <button type="button" class="btn save-btn">Save Changes</button>
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
    const form = document.getElementById('updateForm');

    saveButton.addEventListener('click', () => {
        dialog.showModal(); // Show the confirmation dialog
    });

    confirmButton.addEventListener('click', () => {
        dialog.close();
        form.submit(); // Submit the form when "Yes" is clicked
    });

    cancelButton.addEventListener('click', () => {
        dialog.close(); // Close the dialog on "No"
        window.location.href = 'http://localhost/ExploreEase/hotel/dashboard?page=bookings'; // Redirect without saving
    });
</script>