<link rel="stylesheet" href="../public/css/heritagemarket_dashboard/edit_profile.css">

<div class="profile-container">
    <h1>Edit Product Details</h1>

    <form method="post" action="../heritagemarket/editProduct" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" placeholder="Enter product name" value="<?php echo $product['Name']; ?>" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" placeholder="Enter price" value="<?php echo $product['Price']; ?>" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Enter description" style="width: 100%; padding: 10px; border: none; border-radius: 5px;"><?php echo $product['Description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <input type="hidden" name="productID" value="<?php echo $product['ProductID']; ?>">

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="submit" class="save-btn">Edit Product</button>
        </div>
    </form>
</div>