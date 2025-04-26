<link rel="stylesheet" href="../public/css/culturalevent_dashboard/bookings.css">

<h1>Bookings</h1>

<?php if (!isset($bookings)): ?>
<div class="alert alert-warning">Error: No booking data available.</div>
<?php else: ?>

<div class="event-container">
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>Date</th>
                <th>Quantity</th>
                <th>Status</th>
                <th>Event</th>
                <th>Traveler</th>
                <?php if (isset($bookings[0]['Amount'])): ?>
                <th>Amount</th>
                <?php endif; ?>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($bookings)): ?>
                <?php foreach ($bookings as $booking): ?>
                    <tr>
                        <td><?= htmlspecialchars($booking['BookingID']) ?></td>
                        <td><?= htmlspecialchars($booking['Date'] ?? $booking['BookingDate'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($booking['Quantity'] ?? $booking['TicketCount'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($booking['Status'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($booking['EventName'] ?? 'N/A') ?></td>
                        <td><?= isset($booking['FirstName']) && isset($booking['LastName']) ? 
                              htmlspecialchars($booking['FirstName'] . ' ' . $booking['LastName']) : 'N/A' ?></td>
                        <?php if (isset($booking['Amount'])): ?>
                        <td><?= htmlspecialchars($booking['Amount']) ?></td>
                        <?php endif; ?>
                        <td class="action-buttons">
                            <button class="reply-btn"><a href="?page=bookings&action=edit&id=<?= $booking['BookingID'] ?>">Edit</a></button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="<?= isset($bookings[0]['Amount']) ? '8' : '7' ?>" style="text-align: center;">No bookings found. This could be because there are no bookings yet or there might be an issue with the database connection.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>
<?php endif; ?>