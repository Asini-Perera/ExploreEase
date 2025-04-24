<link rel="stylesheet" href="../public/css/culturalevent_dashboard/event_list.css">

<div class="event-container">
    <div class="top">
        <h1>Event List</h1>

        <div class="action-buttons">
            <a class="add-btn" href="?page=event&action=add">Add Event</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Address</th>
                <th>Event Date</th>
                <th>Start Time</th>
                <th>End Time</th>
                <th>Description</th>
                <th>Capacity</th>
                <th>Ticket Price</th>
                <th>Status</th>
                <th>Actions</th>
            </tr>
        </thead>
       <tbody>
            <?php if (isset($events) && !empty($events)): ?>
                <?php foreach ($events as $event): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['Name']) ?></td>
                        <td><?= htmlspecialchars($event['Address']) ?></td>
                        <td><?= htmlspecialchars($event['Date']) ?></td>
                        <td><?= htmlspecialchars($event['StartTime']) ?></td>
                        <td><?= htmlspecialchars($event['EndTime']) ?></td>
                        <td><?= htmlspecialchars(substr($event['Description'], 0, 50)) . (strlen($event['Description']) > 50 ? '...' : '') ?></td>
                        <td><?= htmlspecialchars($event['Capacity']) ?></td>
                        <td><?= htmlspecialchars($event['TicketPrice']) ?></td>
                        <td><?= htmlspecialchars($event['Status']) ?></td>
                        <td>
                            <div class="action-links">
                                <a href="?page=event&action=edit&id=<?= $event['EventID'] ?>" class="edit">Edit</a>
                                <a href="?page=event&action=delete&id=<?= $event['EventID'] ?>" class="delete" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                            </div>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="10" class="no-data">No events found</td>
                </tr>
            <?php endif; ?>
       </tbody>
    </table>
</div>