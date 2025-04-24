<link rel="stylesheet" href="../public/css/restaurant_dashboard/edit_profile.css">

<div class="profile-container">
    <h1>Edit Profile Details</h1>
    
    <form id="edit-profile-form" action="../restaurant/update" method="POST" enctype="multipart/form-data">

        <input type="hidden" name="restaurantID" value="<?php echo $_SESSION['RestaurantID']; ?>">

        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="<?php echo $_SESSION['Name']; ?>">
        </div>
        <div class="form-group">
            <label for="location">Address</label>
            <input type="text" id="address" name="address" value="<?php echo $_SESSION['Address']; ?>">
        </div>
        <div class="form-group">
            <label for="contact_no">Contact No</label>
            <input type="text" id="contact_no" name="contact_no" value="<?php echo $_SESSION['ContactNo']; ?>">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION['Email']; ?>">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description" value="<?php echo $_SESSION['Description']; ?>">
        </div>
        <div class="form-group">
            <label for="tagline">Tag Line</label>
            <input type="text" id="tagline" name="tagline" value="<?php echo $_SESSION['Tagline'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" id="website" name="website" value="<?php echo $_SESSION['Website']; ?>">
        </div>
        <div class="form-group">
            <label for="open_hours">Weekdays Open Hours</label>
            <input type="text" id="open_hours" name="weekdays_openhours" value="<?php echo $_SESSION['WeekdayOpenHours'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="open_hours">Weekends Open Hours</label>
            <input type="text" id="open_hours" name="weekends_openhours" value="<?php echo $_SESSION['WeekendOpenHours'] ?? ''; ?>">
        </div>
        <div class="form-group">
            <label for="cuisine_types">Cuisine Types</label>
            <input type="text" id="cuisine_types" name="cuisine_types" value="<?php echo $_SESSION['CuisineType']; ?>">
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
        <div class="form-group">
            <label for="menupdf">Menu PDF</label>
            <input type="file" id="menupdf" name="menupdf" >
        </div>

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="submit" class="save-btn" onclick=" ">Save</button>     
        </div>
        
    </form>
</div>