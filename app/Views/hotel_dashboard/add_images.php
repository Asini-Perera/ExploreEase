<link rel="stylesheet" href="../public/css/hotel_dashboard/add_images.css">

<div class="form-content">
    <h1>Upload Images to add Customer side view</h1>

    <form action="../hotel/addImage" method="post" enctype="multipart/form-data" id="uploadImage">

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
            <label>Preview </label>
            <img id="preview-image" src="#" alt="Image Preview">
        </div><br>

        <button type="button" class="submit-btn" >Upload</button> 
    </form>
     
</div>

    <dialog id="openDialog">
        <p>Are you sure do you want to upload this image?</p>
        <div class="dialog-buttons">
            <button id="confirm" class="confirm-btn">Yes</button>
            <button id="cancel" class="cancel-btn">No</button>
        </div>
    </dialog>

<script src="../public/js/hotel_dashboard/add_images.js"> </script>