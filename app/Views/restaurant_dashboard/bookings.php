<link rel="stylesheet" href="../public/css/restaurant_dashboard/bookings.css">

<h1>New Bookings</h1>

<div class="booking-container">
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Date</th>
                <th>Booking Date</th>
                <th>Time</th>
                <th>Special Request</th>
                <th>Number of Guests</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($bookings) && is_array($bookings)): ?>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['Name']) ?></td>
                        <td><?= htmlspecialchars($booking['Email']) ?></td>
                        <td><?= date('Y-m-d', strtotime($booking['Date'])) ?></td>
                        <td><?= htmlspecialchars($booking['BookingDate']) ?></td>
                        <td><?= htmlspecialchars($booking['BookingTime']) ?></td>
                        <td><?= htmlspecialchars($booking['SpecialRequest']) ?></td>
                        <td><?= htmlspecialchars($booking['NoOfGuests']) ?></td>
                        <td class="action-buttons">
                            <button
                                class="reply-btn"
                                onclick="openPopup(
                                    '<?= $booking['BookingID'] ?>', 
                                    '<?= htmlspecialchars($booking['Email']) ?>',
                                    '<?= htmlspecialchars($booking['Name']) ?>',
                                    '<?= htmlspecialchars($booking['BookingDate']) ?>',
                                    '<?= htmlspecialchars($booking['BookingTime']) ?>'
                                )">
                                Send Table No
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="8" style="text-align: center;">No new bookings found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Popup Modal (only one) -->
<div class="popup" id="popup">
    <div class="modal-content">
        <form action="../restaurant/sendTableNo" method="POST" id="tableNoForm">
            <input type="hidden" name="booking_id" id="bookingIdInput">
            <input type="hidden" name="booking_email" id="bookingEmailInput">
            <input type="hidden" name="customer_name" id="customerNameInput">
            <input type="hidden" name="booking_date" id="bookingDateInput">
            <input type="hidden" name="booking_time" id="bookingTimeInput">
            <input type="hidden" name="restaurant_name" value="<?= htmlspecialchars($_SESSION['Name']) ?>">

            <span class="close-btn" onclick="closePopup()">&times;</span>

            <h3>Add Table Number</h3>
            <input type="text" name="table_no" id="tableNoInput" placeholder="Enter Table No" required>

            <br>
            <button type="submit" id="submitTableNo">Send Email</button>
        </form>
    </div>
</div>

<!-- JavaScript -->
<script>
    const popup = document.getElementById("popup");
    const bookingIdInput = document.getElementById("bookingIdInput");
    const bookingEmailInput = document.getElementById("bookingEmailInput");
    const customerNameInput = document.getElementById("customerNameInput");
    const bookingDateInput = document.getElementById("bookingDateInput");
    const bookingTimeInput = document.getElementById("bookingTimeInput");

    function openPopup(bookingId, bookingEmail, customerName, bookingDate, bookingTime) {
        bookingIdInput.value = bookingId;
        bookingEmailInput.value = bookingEmail;
        customerNameInput.value = customerName;
        bookingDateInput.value = bookingDate;
        bookingTimeInput.value = bookingTime;
        popup.style.display = "block";
    }

    function closePopup() {
        popup.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target === popup) {
            closePopup();
        }
    }
</script>