<link rel="stylesheet" href="../public/css/hotel_dashboard/bookings.css">

<div class="menu-container">
    <div class="top">
        <h1>Bookings</h1><span></span>
        <!-- <div class="action-buttons">
            <button class="add-btn"><a href="?page=booking&action=add">Add Booking</a></button>
        </div> -->
    </div>

    <table>
        <thead>
            <tr>
                <th>CheckInDate</th>
                <th>CheckOutDate</th>
                <th>Date</th>
                <th>Payment Status</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            
            if (isset($bookings) && !empty($bookings)): 
                foreach ($bookings as $booking): 
            ?>
                <tr>
                    <td><?= isset($booking['CheckInDate']) ? $booking['CheckInDate'] : 'N/A' ?></td>
                    <td><?= isset($booking['CheckOutDate']) ? $booking['CheckOutDate'] : 'N/A' ?></td>
                    <td><?= isset($booking['Date']) ? $booking['Date'] : 'N/A' ?></td>
                    <td><?= isset($booking['Status']) ? $booking['Status'] : 'N/A' ?></td>
                    <td class="action-buttons">
                        <button class="edit-btn"><a href="?page=bookings&action=edit&id=<?= $booking['BookingID'] ?>">Edit</a></button>
                        <button class="delete-btn"><a href="?page=bookings&action=delete&id=<?= $booking['BookingID'] ?>">Delete</a></button>
                    </td>
                </tr>
            <?php 
                endforeach; 
            else: 
            ?>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 20px;">No booking records found</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>