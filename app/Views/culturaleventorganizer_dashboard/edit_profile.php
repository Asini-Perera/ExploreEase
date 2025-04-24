<link rel="stylesheet" href="../public/css/culturalevent_dashboard/edit_profile.css">

<div class="profile-container">
    <h1>Edit Profile Details</h1>
    
    <form id="edit-profile-form" action="../culturaleventorganizer/update" method="POST">
        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <?php echo '<img src="' . $_SESSION['ProfileImage'] . '" alt="Profile Image" class="profile-img">'; ?>   
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION['Email']; ?>" readonly>
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
            <input type="text" id="description" name="description" value="<?php echo $_SESSION['Description']; ?>">
        </div>
        <div class="form-group">
            <label for="sm_link">Facebook Link</label>
            <input type="text" id="facebookLink" name="facebook_link" value="<?php echo $_SESSION['FacebookLink'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="sm_link">Instagram Link</label>
            <input type="text" id="instagramLink" name="instagram_link" value="<?php echo $_SESSION['InstagramLink'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="sm_link">TikTok Link</label>
            <input type="text" id="tiktoklink" name="tiktok_link" value="<?php echo $_SESSION['TikTokLink'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="sm_link">YouTube Link</label>
            <input type="text" id="youtubeLink" name="youtube_link" value="<?php echo $_SESSION['YouTubeLink'] ?? ''; ?>">
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