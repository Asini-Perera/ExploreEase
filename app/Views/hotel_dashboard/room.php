<link rel="stylesheet" href="../public/css/hotel_dashboard/room_list.css">

<div class="menu-container">
    <div class="top">
            <h1>Room List</h1><span></span>

            <div class="action-buttons">
                <button class="add-btn"><a href="?page=room&action=add">Add Room</a></button>
            </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Room No</th>
                <th>Room Type</th>
                <th>Price</th>
                <th>Capacity</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($rooms as $room) : ?>
                <tr>
                    <td><?= $room['RoomID'] ?></td>
                    <td><?= $room['Type'] ?></td>
                    <td>Rs. <?= $room['Price'] ?></td>
                    <td><?= $room['MaxOccupancy'] ?></td>
                    <td><?= $room['Description'] ?></td>
                    <td>
                        <?php if (!empty($room['ImgPath']) && file_exists($_SERVER['DOCUMENT_ROOT'] . $room['ImgPath'])): ?>
                            <img src="<?= $room['ImgPath'] ?>" class="room-img" alt="Room Image">
                        <?php else: ?>
                            <img src="../public/images/default-room.png" class="room-img" alt="Default Room Image">
                        <?php endif; ?>
                    </td>
                    <td class="action-buttons">
                        <button class="edit-btn"><a href="?page=room&action=edit&id=<?= $room['RoomID'] ?>">Edit</a></button>
                        <button class="delete-btn"><a href="?page=room&action=delete&id=<?= $room['RoomID'] ?>">Delete</a></button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>