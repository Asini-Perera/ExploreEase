<link rel="stylesheet" href="../public/css/admin_dashboard/profile.css">

<div class="profile-card">
    <div class="profile-picture">
        <img src="<?php echo $_SESSION['ProfileImage']; ?>" alt="Admin Profile Picture">
    </div>
    <div class="profile-details">
        <h2> <?php echo $_SESSION['FirstName'] . ' ' . $_SESSION['LastName']; ?> </h2>
        
        <div class="detail-item">
            <span class="detail-label">Email:</span>
            <span class="detail-value"> <?php echo $_SESSION['Email']; ?> </span>
        </div>
        <div class="detail-item">
            <span class="detail-label">Contact No:</span>
            <span class="detail-value"> <?php echo $_SESSION['ContactNo']; ?> </span> 
        </div>
    </div>
    <div class="profile-actions">
        <a href="?page=profile&action=edit" class="btn">Edit Profile</a>
        <a href="?page=profile&action=changepassword" class="btn">Change Password</a>
    </div>
</div>

