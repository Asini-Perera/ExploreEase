<link rel="stylesheet" href="../public/css/heritagemarket_dashboard/product_list.css">

<div class="product-container">
    <div class="top">
        <h1>Product List</h1>

        <div class="action-buttons">
            <a class="add-btn" href="?page=product&action=add">Add Product</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Price</th>
                <th>Description</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>

            <?php foreach ($products as $product) : ?>
                <tr>
                    <td><?= $product['Name'] ?></td>
                    <td>Rs. <?= $product['Price'] ?></td>
                    <td><?= $product['Description'] ?></td>
                    <td><img src="<?= $product['ImgPath'] ?>" class="product-img"></td>
                    <td class="action-buttons">
                        <button class="edit-btn"><a href="?page=product&action=edit&id=<?= $product['ProductID'] ?>">Edit</a></button>
                        <button class="delete-btn"><a href="?page=product&action=delete&id=<?= $product['ProductID'] ?>">Delete</a></button>
                    </td>
                </tr>
            <?php endforeach; ?>

            <!-- <tr>
                <td>Traditional Masks</td>
                <td>Rs.2430</td>
                <td>Traditional masks made by local artisans</td>
                <td><img src="../public/images/mask.jpg" alt="Product Image" class="product-img"></td>
                <td>
                    <button class="edit-btn" href="">Edit</button>
                    <button class="delete-btn" href="">Delete</button>
            </tr>
            <tr>
                <td>Handmade Jewelry</td>
                <td>Rs.1500</td>
                <td>Handmade jewelry made by local artisans</td>
                <td><img src="../public/images/jewelry.jpg" alt="Product Image" class="product-img"></td>
                <td>
                    <button class="edit-btn" href="">Edit</button>
                    <button class="delete-btn" href="">Delete</button>
            </tr>
            <tr>
                <td>Handicrafts</td>
                <td>Rs.2000</td>
                <td>Handicrafts made by local artisans</td>
                <td><img src="../public/images/handicrafts.jpg" alt="Product Image" class="product-img"></td>
                <td>
                    <button class="edit-btn" href="">Edit</button>
                    <button class="delete-btn" href="">Delete</button>
            </tr>
            <tr>
                <td>Paintings</td>
                <td>Rs.3000</td>
                <td>Paintings made by local artists</td>
                <td><img src="../public/images/paintings.jpg" alt="Product Image" class="product-img"></td>
                <td>
                    <button class="edit-btn" href="">Edit</button>
                    <button class="delete-btn" href="">Delete</button>
            </tr>
            <tr>
                <td>Handmade Bags</td>
                <td>Rs.1200</td>
                <td>Handmade bags made by local artisans</td>
                <td><img src="../public/images/bags.jpg" alt="Product Image" class="product-img"></td>
                <td>
                    <button class="edit-btn" href="">Edit</button>
                    <button class="delete-btn" href="">Delete</button>
            </tr>
            <tr>
                <td>Handmade Toys</td>
                <td>Rs.500</td>
                <td>Handmade toys made by local artisans</td>
                <td><img src="../public/images/toys.jpg" alt="Product Image" class="product-img"></td>
                <td>
                    <button class="edit-btn" href="">Edit</button>
                    <button class="delete-btn" href="">Delete</button>
            </tr>
            <tr>
                <td>Handmade Candles</td>
                <td>Rs.300</td>
                <td>Handmade candles made by local artisans</td>
                <td><img src="../public/images/candles.jpg" alt="Product Image" class="product-img"></td>
                <td>
                    <button class="edit-btn" href="">Edit</button>
                    <button class="delete-btn" href="">Delete</button>
            </tr>
            <tr>
                <td>Handmade Soaps</td>
                <td>Rs.200</td>
                <td>Handmade soaps made by local artisans</td>
                <td><img src="../public/images/soaps.jpg" alt="Product Image" class="product-img"></td>
                <td>
                    <button class="edit-btn" href="">Edit</button>
                    <button class="delete-btn" href="">Delete</button>
            </tr> -->
        </tbody>
    </table>
</div>