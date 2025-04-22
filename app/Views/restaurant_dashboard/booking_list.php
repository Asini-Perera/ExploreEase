<link rel="stylesheet" href="../public/css/restaurant_dashboard/bookings.css">

<h1>Bookings</h1>

<div class="booking-container">
    <table>
        <thead>
            <tr>
                <th>Customer Name</th>
                <th>Email</th>
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
            <?php foreach ($bookings as $reservation): ?>
                <tr>
                    <td><?= htmlspecialchars($reservation['Name']) ?></td>
                    <td><?= htmlspecialchars($reservation['Email']) ?></td>
                    <td><?= date('d-m-Y', strtotime($reservation['Date'])) ?></td>
                    <td><?= $reservation['BookingDate']  ?></td>
                    <td><?= $reservation['BookingTime']  ?></td>
                    <td><?= $reservation['NoOfGuests']  ?></td>
                    <td><?= htmlspecialchars($reservation['SpecialRequest'])  ?></td>
                    <td><?= $reservation['TableNumber']  ?></td>
                    
                </tr>

            <?php endforeach; ?>  
                
            <?php else: ?>
                <tr><td colspan="6" style="text-align: center;">No bookings found.</td></tr>
            <?php endif; ?> 

        </tbody>
    </table>
</div>