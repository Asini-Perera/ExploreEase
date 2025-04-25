<link rel="stylesheet" href="../public/css/hotel_dashboard/edit_profile.css">

<div class="profile-container">
    <h1>Edit Profile Details</h1>

    <form id="edit-profile-form" action="../hotel/update" method="POST">
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email" value="<?php echo $_SESSION['Email']; ?>">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter name" value="<?php echo $_SESSION['Name']; ?>">
        </div>

        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Enter address" value="<?php echo $_SESSION['Address']; ?>">
        </div>
        <div class="form-group">
            <label for="contact_no">Contact No</label>
            <input type="text" id="contact_no" name="contact_no" placeholder="Enter contact no" value="<?php echo $_SESSION['ContactNo']; ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" placeholder="Enter description" value="<?php echo $_SESSION['Description']; ?>">
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" id="website" name="website" placeholder="Enter website" value="<?php echo $_SESSION['Website']; ?>">
        </div>
        <div class="form-group">
            <label for="tagline">Tagline</label>
            <input type="text" id="tagline" name="tagline" placeholder="Enter tagline" value="<?php echo $_SESSION['Tagline']; ?>">
        </div>
        <div class="form-group">
            <label for="facebook_link">Facebook Link</label>
            <input type="text" id="facebook_link" name="facebook_link" placeholder="Enter Facebook link" value="<?php echo $_SESSION['FacebookLink']; ?>">
        </div>
        <div class="form-group">
            <label for="instagram_link">Instagram Link</label>
            <input type="text" id="instagram_link" name="instagram_link" placeholder="Enter Instagram link" value="<?php echo $_SESSION['InstagramLink']; ?>">
        </div>
        <div class="form-group">
            <label for="tiktok_link">TikTok Link</label>
            <input type="text" id="tiktok_link" name="tiktok_link" placeholder="Enter TikTok link" value="<?php echo $_SESSION['TikTokLink']; ?>">
        </div>
        <div class="form-group">
            <label for="youtube_link">Youtube Link</label>
            <input type="text" id="youtube_link" name="youtube_link" placeholder="Enter Youtube link" value="<?php echo $_SESSION['YoutubeLink']; ?>">
        </div>

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="button" class="save-btn" onclick="">Save</button>
        </div>

    </form>
</div>

<dialog id="openDialog">
    <p>Are you sure do you want to edit details?</p>
    <div class="dialog-buttons">
        <button id="confirm" class="confirm-btn">Yes</button>
        <button id="cancel" class="cancel-btn">No</button>
    </div>
</dialog>


<script>
    const dialog = document.getElementById('openDialog');
    const confirmButton = document.getElementById('confirm');
    const cancelButton = document.getElementById('cancel');
    const saveButton = document.querySelector('.save-btn');
    const form = document.getElementById('edit-profile-form');

    saveButton.addEventListener('click', () => {
        dialog.showModal(); // Show the confirmation dialog
    });

    confirmButton.addEventListener('click', () => {
        dialog.close();
        form.submit(); // Submit the form when "Yes" is clicked
    });

    cancelButton.addEventListener('click', () => {
        dialog.close(); // Close the dialog on "No"
        window.location.href = 'http://localhost/ExploreEase/hotel/dashboard?page=profile'; // Redirect without saving
    });
</script>

<!-- <script>
function toggleEditForm() {
    var form = document.getElementById('edit-profile-form');
    if (form.style.display === 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}
</script> -->