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
                    <td><?= $room['Type'] ?></td>
                    <td>Rs. <?= $room['Price'] ?></td>
                    <td><?= $room['MaxOccupancy'] ?></td>
                    <td><?= $room['Description'] ?></td>
                    <td><img src="<?= $room['ImgPath'] ?>" class="room-img"></td>
                    <td class="action-buttons">
                        <button class="edit-btn"><a href="?page=room&action=edit&id=<?= $room['RoomID'] ?>">Edit</a></button>
                        <button class="delete-btn"><a href="?page=room&action=delete&id=<?= $room['RoomID'] ?>">Delete</a></button>
                    </td>
                </tr>
            <?php endforeach; ?>
           
        </tbody>
    </table>
</div>