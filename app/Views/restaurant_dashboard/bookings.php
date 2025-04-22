<link rel="stylesheet" href="../public/css/restaurant_dashboard/bookings.css">

<h1>New Bookings</h1>

<div class="booking-container">
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Date </th>
                <th>Booking Date </th>
                <th>Time </th>
                <th >Special Request</th>
                <th>Number of Guests</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td> </td>
                <td class="action-buttons">
                    <button class="reply-btn" id="sendTableBtn">Send Table No</button>
                </td>
            </tr>
            
             

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

                
             
        </tbody>
    </table>
</div>