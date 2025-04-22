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
            </tr>
        </thead>
        
        <tbody>
        <?php if (!empty($bookings) && is_array($bookings)): ?>
            <?php foreach ($bookings as $booking): ?>
                <tr>
                    <td><?= htmlspecialchars($booking['Name']) ?></td>
                    <td><?= date('d-m-Y', strtotime($booking['Date'])) ?></td>
                    <td><?= $booking['BookingDate']  ?></td>
                    <td><?= $booking['NoOfGuests']  ?></td>
                    <td><?= htmlspecialchars($booking['SpecialRequest'])  ?></td>
                    <td><?= $booking['TableNumber']  ?></td>
                     
                </tr>

            <?php endforeach; ?>  
                
        <?php else: ?>
            <tr><td colspan="6" style="text-align: center;">No bookings found.</td></tr>
        <?php endif; ?> 

        </tbody>
    </table>
</div>