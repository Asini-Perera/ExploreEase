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
                    <td><img src="<?= $food['ImgPath'] ?>" class="room-img"></td>
                    <td class="action-buttons">
                        <button class="edit-btn"><a href="?page=menu&action=edit&id=<?= $food['MenuID'] ?>">Edit</a></button>
                        <button class="delete-btn"><a href="?page=menu&action=delete&id=<?= $food['MenuID'] ?>">Delete</a></button>
                    </td>
                </tr>
            <?php endforeach; ?>

            <!-- <tr>
                <td>Rs. 5000.00</td>
                <td>2</td>
                <td>Deluxe Room with a king-sized bed and a view of the city</td>
                <td><img src="../public/images/room.jpg" class="room-img"></td>
                <td class="action-buttons">
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Rs. 3000.00</td>
                <td>2</td>
                <td>Standard Room with a queen-sized bed and a view of the city</td>
                <td><img src="../public/images/room.jpg" class="room-img"></td>
                <td class="action-buttons">
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Rs. 7000.00</td>
                <td>4</td>
                <td>Family Room with two queen-sized beds and a view of the city</td>
                <td><img src="../public/images/room.jpg" class="room-img"></td>
                <td class="action-buttons">
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Rs. 10000.00</td>
                <td>6</td>
                <td>Presidential Suite with a king-sized bed, a living room, and a view of the city</td>
                <td><img src="../public/images/room.jpg" class="room-img"></td>
                <td class="action-buttons">
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Delete</button>
                </td>
            </tr>
            <tr>
                <td>Rs. 5000.00</td>
                <td>2</td>
                <td>Deluxe Room with a king-sized bed and a view of the city</td>
                <td><img src="../public/images/room.jpg" class="room-img"></td>
                <td class="action-buttons">
                    <button class="edit-btn">Edit</button>
                    <button class="delete-btn">Delete</button>
                </td>
            </tr> -->
        </tbody>
    </table>
</div>