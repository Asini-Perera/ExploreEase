<link rel="stylesheet" href="../public/css/restaurant_dashboard/bookings.css">

<h1>Bookings</h1>

<div class="menu-container">
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Date</th>
                <th>Booking Date</th>
                <th>Time </th>
                <th>Number of Guests</th>
                <th>Special Request</th>
                <th>Table Number</th>
                <th>Actions</th>
            </tr>
        </thead>
        
        <tbody>
 
            <!-- <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= htmlspecialchars($booking['Name']) ?></td>
                    <td><?= $booking['BookingDate']  ?></td>
                    <td><?= $booking['BookingDate']  ?></td>
                    <td><?= $booking['NoOfGuests']  ?></td>
                    <td><?= htmlspecialchars($booking['SpecialRequest'])  ?></td>
                    <td><?= $booking['TableNumber']  ?></td>
                    <td class="action-buttons"> 
                        <button class="delete-btn"><a href="?page=booking_list&action=delete&id=<?= $booking ['BookingID'] ?>">Delete</a></button>
                    </td>
                </tr>

            <?php endforeach; ?>   -->
                <tr>
                    <td>John Doe</td>
                    <td>2024.10.18</td>
                    <td>2024.10.18</td>
                    <td>12:30 PM</td>
                    <td>4</td>
                    <td>none </td>
                    <td>5</td>
                    <td class="action-buttons">
                        <button class="edit-btn">Edit</button>
                        <button class="delete-btn">Delete</button>
                    </td>
                </tr>
            <tr>
                <td>Jane Doe</td>
                <td>2024.10.18</td>
                <td>2024.10.18</td>
                <td>1:00 PM</td>
                <td>2</td> 
                <td>none</td>
                <td>3</td>
                <td class="action-buttons">
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Delete</button>
                </td>
            </tr>
            
        </tbody>
    </table>
</div>