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
                            <button class="delete-btn"><a href="?page=menu&action=delete&id=<?= $food['MenuID'] ?>">Delete</a></button>
                        </td>
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