<link rel="stylesheet" href="../public/css/heritagemarket_dashboard/edit_profile.css">

<div class="profile-container">
    <h1>Add a New Product</h1>

    <form method="post" action="../heritagemarket/addProduct" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" placeholder="Enter product name" required>
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" placeholder="Enter price" required>
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Enter description" style="width: 100%; padding: 10px; border: none; border-radius: 5px;"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="submit" class="save-btn">Add Product</button>
        </div>
    </form>
</div>