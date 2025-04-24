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
            <tr>
                <td>Esala Perehara</td>
                <td>Kandy</td>
                <td>2021-07-14</td>
                <td>10:00:00</td>
                <td>22:00:00</td>
                <td>Esala Perehara is a grand festival celebrated with elegant costumes and is held in Kandy.</td>
                <td>1000</td>
                <td>Rs. 500.00</td>
                <td>Active</td>
                <td class="action-buttons">
                    <button class="edit-btn" style="background-color: #6fa857; width: 100px; padding: 8px 10px; margin: 5px; color: white; border: none; border-radius: 4px; cursor: pointer;"><a href="?page=event&action=edit&id=<?= $post['EventID'] ?>"></a>Edit</button>
                    <button class="delete-btn" style="background-color: #d9534f; width: 100px; padding: 8px 10px; margin: 5px; color: white; border: none; border-radius: 4px; cursor: pointer;"><a href="?page=event&action=delete&id=<?= $post['EventID'] ?>">Delete</a></button>
                </td>
            </tr>
            
        </tbody>
    </table>
</div>