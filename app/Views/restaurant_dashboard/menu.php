<link rel="stylesheet" href="../public/css/restaurant_dashboard/menu_list.css">

<div class="menu-container">
    <div class="top">
        <h1>Menu List</h1><span></span>

        <div class="action-buttons">
            <a class="add-btn" href="?page=menu&action=add">Add Menu</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Food Name</th>
                <th>Price</th>
                <th>Category</th>
                <th>Image</th>
                <th>Popular Dish</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($menus) && is_array($menus)): ?>
                <?php foreach ($menus as $food) : ?>
                    <tr>
                        <td><?= $food['FoodName'] ?></td>
                        <td>Rs. <?= $food['Price'] ?></td>
                        <td><?= $food['FoodCategory'] ?></td>
                        <td><img src="<?= $food['ImgPath'] ?>" class="food-img"></td>
                        <td><?= $food['IsPopular'] == 1 ? 'Yes' : 'No' ?></td>
                        <td class="action-buttons">
                            <button class="edit-btn"><a href="?page=menu&action=edit&id=<?= $food['MenuID'] ?>">Edit</a></button>
                            <button class="delete-btn" data-delete-url="?page=menu&action=delete&id=<?= $food['MenuID'] ?>">Delete</a></button>
                        </td>

                        <dialog id="deleteDialog">
                            <p>Are you sure you want to delete this menu?</p>
                            <div class="dialog-buttons">
                                <button id="deleteConfirm" class="confirm-btn">Yes</button>
                                <button id="deleteCancel" class="cancel-btn">No</button>
                            </div>
                        </dialog>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="6" style="text-align: center;">No menu items found.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>


<script>
    const deleteDialog = document.getElementById('deleteDialog');
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const confirmDelete = document.getElementById('deleteConfirm');
    const cancelDelete = document.getElementById('deleteCancel');

    let deleteUrl = '';

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            deleteUrl = button.getAttribute('data-delete-url');
            deleteDialog.showModal();
        });
    });

    confirmDelete.addEventListener('click', () => {
        deleteDialog.close();
        window.location.href = deleteUrl;
    });

    cancelDelete.addEventListener('click', () => {
        deleteDialog.close();
    });
</script>
