<link rel="stylesheet" href="../public/css/restaurant_dashboard/bookings.css">

<h1>New Bookings</h1>

<div class="booking-container">
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
                <th>Date </th>
                <th>Booking Date </th>
                <th>Time </th>
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
                    <td><?= date('Y-d-m', strtotime($booking['Date'])) ?></td>
                    <td><?= $booking['BookingDate'] ?></td>
                    <td><?= $booking['BookingTime'] ?></td>
                    <td><?= $booking['NoOfGuests'] ?></td>
                    <td><?= htmlspecialchars($booking['SpecialRequest']) ?></td>
                    <td class="action-buttons">
                    <button class="reply-btn" id="sendTableBtn" onclick="openPopup()"> Send Table No </button>

                    <div class="popup" id="popup">
                    <div class="modal-content">
                        <form action="../../controllers/TableBookingController.php?action=sendTableNo" method="POST" id="tableNoForm">
                        <input type="hidden" name="booking_id" id="bookingIdInput" value="<?= htmlspecialchars($booking['BookingID']) ?>">
                        <span class="close-btn">&times;</span>

                        <h3>Add Table Number</h3>
                        
                        <label for="tableNo">Table No:</label>
                        <input type="text" name="table_no" id="tableNoInput" placeholder="Enter Table No">
                        
                        <button type="submit" id="submitTableNo" onclick="closePopup()" >Send Email</button>
                        </form>
                    </div>
                    </td>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>
                <tr>

                    <td colspan="8" style="text-align: center;">No new bookings found.</td>

                </tr>
            <?php endif; ?>

            <!-- Modal -->
            <div id="tableNoModal" class="modal">
                <div class="modal-content">
                    <span class="close-btn">&times;</span>
                    <h3>Add Table Number</h3>
                    <input type="email" id="emailInput" placeholder="Enter Email" required>
                    <input type="text" id="tableNoInput" placeholder="Enter Table No">

                    <button id="submitTableNo">Send Email</button>
                </div>
            </div>

            <script src="https://smtpjs.com/v3/smtp.js"></script>
            <script src="../public/js/restaurant_dashboard/table_no.js"></script>



<

            <script>
                let popup = document.getElementById("popup");

                function openPopup(){
                    
                }
            </script>


                     <!-- Modal -->
                      <!-- <div id="tableNoModal" class="modal">
                    // <div class="modal-content">
                    //     <form action="../../controllers/TableBookingController.php?action=sendTableNo" method="POST" id="tableNoForm">
                    //     <input type="hidden" name="booking_id" id="bookingIdInput" value="<?= htmlspecialchars($booking['BookingID']) ?>">
                    //     <span class="close-btn">&times;</span>

                    //     <h3>Add Table Number</h3>
                        
                    //     <label for="tableNo">Table No:</label>
                    //     <input type="text" name="table_no" id="tableNoInput" placeholder="Enter Table No">
                        
                    //     <button type="submit" id="submitTableNo">Send Email</button>
                    //     </form>
                    // </div>
                    // </div> -->

                    <script src="https://smtpjs.com/v3/smtp.js"></script>
                    <!-- <script src="../public/js/restaurant_dashboard/table_no.js"></script> -->

                
             

        </tbody>
    </table>
</div>