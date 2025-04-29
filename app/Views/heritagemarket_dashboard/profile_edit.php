<link rel="stylesheet" href="../public/css/heritagemarket_dashboard/edit_profile.css">

<div class="profile-container">
    <h1>Edit Profile Details</h1>

    <form id="edit-profile-form" action="../heritagemarket/updateProfile" method="POST">

        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION['Email']; ?>">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $_SESSION['Name']; ?>">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $_SESSION['Address']; ?>">
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
            <label for="website">Website</label>
            <input type="text" id="website" name="website" value="<?php echo $_SESSION['Website']; ?>">
        </div>
        <div class="form-group">
            <label for="tagline">Tagline</label>
            <input type="text" id="tagline" name="tagline" value="<?php echo $_SESSION['Tagline']; ?>">
        </div>
        <div class="form-group">
            <label for="weekend_open_hours">Weekend Open Hours</label>
            <input type="text" id="weekend_open_hours" name="weekend_open_hours" value="<?php echo $_SESSION['WeekendOpenHours']; ?>">
        </div>
        <div class="form-group">
            <label for="weekday_open_hours">Weekday Open Hours</label>
            <input type="text" id="weekday_open_hours" name="weekday_open_hours" value="<?php echo $_SESSION['WeekdayOpenHours']; ?>">
        </div>
        <div class="form-group">
            <label for="facebook_link">Facebook Link</label>
            <input type="text" id="facebook_link" name="facebook_link" value="<?php echo $_SESSION['FacebookLink']; ?>">
        </div>
        <div class="form-group">
            <label for="instagram_link">Instagram Link</label>
            <input type="text" id="instagram_link" name="instagram_link" value="<?php echo $_SESSION['InstagramLink']; ?>">
        </div>
        <div class="form-group">
            <label for="tiktok_link">TikTok Link</label>
            <input type="text" id="tiktok_link" name="tiktok_link" value="<?php echo $_SESSION['TikTokLink']; ?>">
        </div>
        <div class="form-group">
            <label for="youtube_link">YouTube Link</label>
            <input type="text" id="youtube_link" name="youtube_link" value="<?php echo $_SESSION['YoutubeLink']; ?>">
        </div>


        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="submit" class="save-btn" onclick="">Save</button>
        </div>

    </form>
</div>

<script src="../public/js/dashboard_templates/edit_profile.js"></script>