<link rel="stylesheet" href="../public/css/culturalevent_dashboard/edit_profile.css">

<div class="profile-container">
    <h1>Edit Profile Details</h1>
    
    <form id="edit-profile-form" action="../culturaleventorganizer/update" method="POST">
        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="file" id="profile_image" name="profile_image">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION['Email']; ?>">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $_SESSION['Name']; ?>">
        </div>
        <div class="form-group">
            <label for="contact_no">Contact No</label>
            <input type="text" id="contact_no" name="contact_no" value="<?php echo $_SESSION['ContactNo']; ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description"><?php echo $_SESSION['Description']; ?></textarea>
        </div>
        <div class="form-group">
            <label for="sm_link">Social Media Link</label>
            <input type="text" id="sm_link" name="sm_link" value="<?php echo $_SESSION['SMLink']; ?>">
        </div>

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="submit" class="save-btn" onclick="">Save</button>     
        </div>
        
    </form>
</div>

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