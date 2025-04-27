<link rel="stylesheet" href="../public/css/culturalevent_dashboard/edit_profile.css">

<div class="profile-container">
    <h1>Edit Profile Details</h1>

    <?php if (isset($_GET['error']) && $_GET['error'] == 'email-exists'): ?>
        <div class="error-message">Email already exists. Please use a different email.</div>
    <?php endif; ?>

    <form id="edit-profile-form" action="../culturaleventorganizer/update" method="POST" enctype="multipart/form-data">
        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="file" id="profile_image" name="profile_image">
            <?php if (!empty($_SESSION['ProfileImage'])): ?>
                <div class="current-image">
                    <img src="<?php echo $_SESSION['ProfileImage']; ?>" alt="Profile Image" class="profile-img" style="width:100px; height:100px;">
                </div>
            <?php endif; ?>
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
            <label for="facebook_link">Facebook Link</label>
            <input type="text" id="facebookLink" name="facebook_link" value="<?php echo $_SESSION['FacebookLink'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="instagram_link">Instagram Link</label>
            <input type="text" id="instagramLink" name="instagram_link" value="<?php echo $_SESSION['InstagramLink'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="tiktok_link">TikTok Link</label>
            <input type="text" id="tiktoklink" name="tiktok_link" value="<?php echo $_SESSION['TikTokLink'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="youtube_link">YouTube Link</label>
            <input type="text" id="youtubeLink" name="youtube_link" value="<?php echo $_SESSION['YouTubeLink'] ?? ''; ?>">
        </div>

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="submit" class="save-btn">Save</button>
        </div>
    </form>
</div>

<script src="../public/js/dashboard_templates/edit_profile.js"></script>