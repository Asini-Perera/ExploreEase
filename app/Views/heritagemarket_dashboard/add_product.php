<link rel="stylesheet" href="../public/css/heritagemarket_dashboard/add_product.css">

<div class="form-content">
    <h1>Product Form </h1>

    <form method="post" action="../heritagemarket/addProduct" enctype="multipart/form-data">
        <div class="form-group">
            <label for="product_name">Product Name</label>
            <input type="text" id="product_name" name="product_name" placeholder="Enter product name">
        </div>
        <div class="form-group">
            <label for="price">Price</label>
            <input type="text" id="price" name="price" placeholder="Enter price">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Enter description"></textarea>
        </div>
        <div class="form-group">
            <label for="image">Image</label>
            <input type="file" id="image" name="image" accept="image/*">
        </div>

        <button type="submit" id="add-product">Add Product</button>


    </form>
</div>