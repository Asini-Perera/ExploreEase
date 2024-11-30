<link rel="stylesheet" href="../public/css/restaurant_dashboard/edit_profile.css">

<div class="profile-container">
    <h1>Edit Profile Details</h1>
    
    <form id="edit-profile-form" method="POST">
        <div class="form-group">
            <label for="profile_image">Profile Image</label>
            <input type="file" id="profile_image" name="profile_image">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" value="John Doe">
        </div>
        <div class="form-group">
            <label for="location">Location</label>
            <input type="text" id="location" name="location" value="Colombo">
        </div>
        <div class="form-group">
            <label for="contact_no">Contact No</label>
            <input type="text" id="contact_no" name="contact_no" value="+94 71 234 5678">
        </div>
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" value="John@gmail.com">
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" id="website" name="website" value="www.johndoe.com">
        </div>
        <div class="form-group">
            <label for="password">Password</label>
            <input type="password" id="password" name="password" value="">
        </div>
        <div class="form-group">
            <label for="open_hours">Open Hours</label>
            <input type="text" id="open_hours" name="open_hours" value="9am - 5pm">
        </div>
        <div class="form-group">
            <label for="cuisine_types">Cuisine Types</label>
            <input type="text" id="cuisine_types" name="cuisine_types" value="Western, Chinese">
        </div>
        <div class="form-group">
            <label for="keywords">Keywords</label>
            <input type="text" id="keywords" name="keywords" value="Fast Food, Family Friendly">
        </div>

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="">Discard</button>
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