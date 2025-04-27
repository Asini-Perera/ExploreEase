<link rel="stylesheet" href="../public/css/admin_dashboard/change_password.css">

<div class="change-password-card">
    <h2>Change Password</h2>
    <form id="updateForm" action="../admin/changepassword" method="POST">
        <div class="form-group">
            <label for="currentPassword">Current Password:</label>
            <input type="password" id="currentPassword" name="currentPassword" required>
        </div>
        <div class="form-group">
            <label for="newPassword">New Password:</label>
            <input type="password" id="newPassword" name="newPassword" required>
        </div>
        <div class="form-group">
            <label for="confirmPassword">Confirm Password:</label>
            <input type="password" id="confirmPassword" name="confirmPassword" required>
        </div>
        <div class="form-actions">
            <button type="button" class="btn">Update Password</button>
            <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancel</button>
        </div>
    </form>
</div>

<dialog id="openDialog">
    <p>Are you sure do you want to change password?</p>
    <div class="dialog-buttons">
        <button id="confirm" class="confirm-btn">Yes</button>
        <button id="cancel" class="cancel-btn">No</button>
    </div>
</dialog>

<script src="../public/js/admin_dashboard/profile.js"></script>
<script src="../public/js/dashboard_templates/edit_profile.js"></script>