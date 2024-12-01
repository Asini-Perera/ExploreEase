<link rel="stylesheet" href="../public/css/admin_dashboard/change_password.css">

<div class="change-password-card">
    <h2>Change Password</h2>
    <form action="/admin/changePassword" method="POST">
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
            <button type="submit" class="btn">Update Password</button>
            <button type="button" class="btn btn-cancel" onclick="window.history.back()">Cancel</button>
        </div>
    </form>
</div>

