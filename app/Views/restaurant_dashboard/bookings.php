<link rel="stylesheet" href="../public/css/restaurant_dashboard/bookings.css">

<h1>Bookings</h1>

<div class="menu-container">
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Booking Date</th>
                <th>Booking Time</th>
                <th>Number of Guests</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>John Doe</td>
                <td>2024.10.18</td>
                <td>12:30 PM</td>
                <td>4</td>
                <td class="action-buttons">
                    <button class="reply-btn" id="sendTableBtn">Send Table No</button>
                </td>
            </tr>
            <tr>
                <td>Jane Doe</td>
                <td>2024.10.18</td>
                <td>1:00 PM</td>
                <td>2</td>
                <td class="action-buttons">
                    <button class="reply-btn"id="sendTableBtn">Send Table No</button>
                </td>
            </tr>
            <tr>
                <td>John Smith</td>
                <td>2024.10.18</td>
                <td>1:30 PM</td>
                <td>3</td>
                <td class="action-buttons">
                    <button class="reply-btn" id="sendTableBtn">Send Table No</button>
                </td>

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

                </td>
            </tr>
        </tbody>
    </table>
</div>