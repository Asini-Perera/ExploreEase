<link rel="stylesheet" href="../public/css/restaurant_dashboard/add_images.css">

<div class="image-container">
    <h1>Upload Images to add Customer side view</h1>

    <form action="../restaurant/addImage" method="post" enctype="multipart/form-data">

        <input type="hidden" name="imageID" value="<?= htmlspecialchars($imageItem['$ImageID']) ?>">

        <div class="form-group">
            <label for="file">Choose Image</label> 
            <input type="file" id="rest-image" name="rest-image" accept="image/*" onchange="previewImage(event)" required>
        </div>

        <div class="form-group">
            <label for="title">Add title to set as image alter text</label> 
            <input type="text" id="title" name="title" required>
        </div>

        
        <div id="preview-container" style="display: none;">
            <p>Preview:</p>
            <img id="preview-image" src="#" alt="Image Preview" style="max-width: 300px; height: auto; border: 1px solid #ccc; padding: 5px;">
        </div><br>

        <button type="submit" class="submit-btn">Upload</button> 
    </form>
     
</div>

<script>
// Image preview before upload
document.getElementById('rest-image').addEventListener('change', function(event) {
    const file = event.target.files[0];

    if (file) {
        const previewContainer = document.getElementById('preview-container');
        const previewImage = document.getElementById('preview-image');
        previewImage.src = URL.createObjectURL(file);
        previewContainer.style.display = 'block';
    }
});
</script>