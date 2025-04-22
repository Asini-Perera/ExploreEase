<link rel="stylesheet" href="../public/css/hotel_dashboard/edit_booking.css">

<?php if (isset($_SESSION['error'])): ?>
    <div class="error-message">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="edit-booking-card">
    <h2>Edit Booking</h2>
    <form action="../hotel/dashboard?action=updateBooking" method="POST">
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
        
        <div class="form-actions">
            <button type="submit" class="btn save-btn">Save Changes</button>
            <button type="button" class="btn discard-btn" onclick="window.history.back()">Discard</button>
        </div>
    </form>
</div>