<link rel="stylesheet" href="../public/css/culturalevent_dashboard/event_list.css">

<div class="event-container">
    <div class="top">
        <h1>Event List</h1>

        <div class="action-buttons">
            <a class="add-btn" href="?page=event&action=add">Add Event</a>
        </div>
    </div>

    <div class="table-responsive">
        <table>
            <thead>
                <tr>
                    <th>Event Name</th>
                    <th>Address</th>
                    <th>Date</th>
                    <th>Time</th>
                    <th>Description</th>
                    <th>Capacity</th>
                    <th>Price</th>
                    <th>Status</th>
                    <th>Image</th>
                    <th>Actions</th>
                </tr>
            </thead>
           <tbody>
                <?php if (isset($events) && !empty($events)): ?>
                    <?php foreach ($events as $event): ?>
                        <tr>
                            <td data-label="Event Name"><?= htmlspecialchars($event['Name']) ?></td>
                            <td data-label="Address"><?= htmlspecialchars(substr($event['Address'], 0, 30)) . (strlen($event['Address']) > 30 ? '...' : '') ?></td>
                            <td data-label="Date"><?= htmlspecialchars($event['Date']) ?></td>
                            <td data-label="Time" class="hide-mobile"><?= htmlspecialchars($event['StartTime']) ?> - <?= htmlspecialchars($event['EndTime']) ?></td>
                            <td data-label="Description" class="hide-mobile"><?= htmlspecialchars(substr($event['Description'], 0, 40)) . (strlen($event['Description']) > 40 ? '...' : '') ?></td>
                            <td data-label="Capacity" class="hide-mobile"><?= htmlspecialchars($event['Capacity']) ?></td>
                            <td data-label="Price"><?= htmlspecialchars($event['TicketPrice']) ?></td>
                            <td data-label="Status"><?= htmlspecialchars($event['Status']) ?></td>
                            <td data-label="Image">
                                <?php if (!empty($event['ImgPath']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $event['ImgPath'])): ?>
                                    <img src="<?= htmlspecialchars($event['ImgPath']) ?>" class="event-img" alt="Event Image">
                                <?php else: ?>
                                    <img src="../public/images/default-event.png" class="event-img" alt="Default Event Image">
                                <?php endif; ?>

                            <td data-label="Actions">
                                <div class="action-buttons">
                                    <a href="?page=event&action=edit&id=<?= $event['EventID'] ?>" class="edit-btn">Edit</a>
                                    <a href="?page=event&action=delete&id=<?= $event['EventID'] ?>" class="delete-btn" onclick="return confirm('Are you sure you want to delete this event?')">Delete</a>
                                </div>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="9" class="no-data">No events found</td>
                    </tr>
                <?php endif; ?>
           </tbody>
        </table>
    </div>
</div>