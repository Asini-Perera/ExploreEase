<link rel="stylesheet" href="../public/css/restaurant_dashboard/add_menu.css">

<div class="form-content">
    <h1>Menu Items</h1>

    <form method="post" action="../restaurant/addMenu" enctype="multipart/form-data" id="updateForm">


        <div class="form-group">
            <label for="title">Food Name:</label>
            <input type="text" name="title" id="title" class="form-control" placeholder="Enter food name" required>
        </div>
        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" name="price" id="price" class="form-control" placeholder="Enter price" required>
        </div>
        <div class="form-group">
            <label for="category">Food Category:</label>
            <select name="category" id="category" class="form-control">
                <option value="default"></option>
                <option value="Breakfast">Breakfast</option>
                <option value="Lunch">Lunch</option>
                <option value="Tea-time">Tea-time</option>
                <option value="Dinner">Dinner</option>
                <option value="Drinks">Drinks</option>
            </select>
        </div>
        <div class="form-group">
            <label for="image">Image:</label>
            <input type="file" id="menu-image" name="menu-image" accept="image/*">
        </div>

        <div class="form-group">
            <label for="popular-dish">Is this popular dish:</label>
            <input type="radio" name="popular-dish" class="popular_food" value="1"> Yes
            <input type="radio" name="popular-dish" class="not_popular" value="0" default> No
        </div>

        <button type="button" name="add_menu" class="menu_btn">Add Menu</button>


        <dialog id="openDialog">
            <p>Are you sure you want to add this item?</p>
            <div class="dialog-buttons">
                <button id="confirm" class="confirm-btn">Yes</button>
                <button id="cancel" class="cancel-btn">No</button>
            </div>
        </dialog>
    </form>
</div>





<script>
    const dialog = document.getElementById('openDialog');
    const confirmButton = document.getElementById('confirm');
    const cancelButton = document.getElementById('cancel');
    const saveButton = document.querySelector('.menu_btn');
    const form = document.getElementById('updateForm');

    saveButton.addEventListener('click', () => {
        dialog.showModal(); // Show the confirmation dialog
    });

    confirmButton.addEventListener('click', () => {
        dialog.close();
        form.submit(); // Submit the form when "Yes" is clicked
    });

    cancelButton.addEventListener('click', () => {
        dialog.close(); // Close the dialog on "No"
        window.location.href = 'http://localhost/ExploreEase/restaurant/dashboard?page=menu'; // Redirect without saving
    });
</script>