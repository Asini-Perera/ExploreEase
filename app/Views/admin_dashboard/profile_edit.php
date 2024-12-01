<link rel="stylesheet" href="../public/css/admin_dashboard/edit_profile.css">

<div class="edit-profile-card">
    <h2>Edit Profile</h2>
    <form action="../admin/update" method="POST" enctype="multipart/form-data">
        <div class="profile-image">
            <label for="profileImage">
                <img src="<?php echo $_SESSION['ProfileImage']; ?>" alt="Current Profile Picture" id="currentProfileImage">
            </label>
            <input type="file" id="profileImage" name="profile_image" accept="image/*" style="display: none;" onchange="previewImage(event)">
            <small>Click the image to upload a new one</small>
        </div>
        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstname" value="<?php echo $_SESSION['FirstName']; ?>" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastname" value="<?php echo $_SESSION['LastName']; ?>" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo $_SESSION['Email']; ?>" required>
        </div>
        <div class="form-group">
            <label for="contactNo">Contact No:</label>
            <input type="tel" id="contactNo" name="contactNo" value="<?php echo $_SESSION['ContactNo']; ?>" required>
        </div>
        <div class="form-actions">
            <button type="submit" class="btn">Save Changes</button>
            <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancel</button>
        </div>
    </form>
</div>

<script>
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            const output = document.getElementById('currentProfileImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>