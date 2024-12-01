<link rel="stylesheet" href="../public/css/admin_dashboard/edit_profile.css">

<div class="edit-profile-card">
    <h2>Edit Profile</h2>
    <form action="/admin/updateProfile" method="POST" enctype="multipart/form-data">
        <div class="profile-image">
            <label for="profileImage">
                <img src="../public/images/user.jpg" alt="Current Profile Picture" id="currentProfileImage">
            </label>
            <input type="file" id="profileImage" name="profileImage" accept="image/*" style="display: none;" onchange="previewImage(event)">
            <small>Click the image to upload a new one</small>
        </div>
        <div class="form-group">
            <label for="firstName">First Name:</label>
            <input type="text" id="firstName" name="firstName" value="John" required>
        </div>
        <div class="form-group">
            <label for="lastName">Last Name:</label>
            <input type="text" id="lastName" name="lastName" value="Doe" required>
        </div>
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="johndoe@example.com" required>
        </div>
        <div class="form-group">
            <label for="contactNo">Contact No:</label>
            <input type="tel" id="contactNo" name="contactNo" value="+1234567890" required>
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
        reader.onload = function () {
            const output = document.getElementById('currentProfileImage');
            output.src = reader.result;
        };
        reader.readAsDataURL(event.target.files[0]);
    }
</script>

