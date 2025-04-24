<link rel="stylesheet" href="../public/css/culturalevent_dashboard/profile.css">

<div class="profile-container">
    <div class="top">
        <h1>Profile Details</h1><span></span>

        <div class="action-buttons">
            <a class="edit-btn" href="?page=profile&action=edit">Edit Profile</a>
            <a class="edit-btn" href="?page=profile&action=change-password">Change Password</a>
        </div>
    </div>
    
    <table>
        <tbody>
            <tr>
                <th>Profile Image</th>
                <td><img src="<?php echo $_SESSION['ProfileImage']; ?>" alt="Profile Image" class="profile-img"></td>
            </tr>
            <tr>
                <th>Email</th>
                <td><?php echo $_SESSION['Email']; ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td><?php echo $_SESSION['Name']; ?></td>
            </tr>
            <tr>
                <th>Contact No</th>
                <td><?php echo $_SESSION['ContactNo']; ?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?php echo $_SESSION['Description']; ?></td>
            </tr>
            <tr>
                <th>Facebook Link</th>
                <td><?php echo $_SESSION['FacebookLink']; ?></td>
            </tr>
            <tr>
                <th>Instagram Link</th>
                <td><?php echo $_SESSION['InstagramLink']; ?></td>
            </tr>
            <tr>
                <th>TikTok Link</th>
                <td><?php echo $_SESSION['TikTokLink']; ?></td>
            </tr>
            <tr>
                <th>YouTube Link</th>
                <td><?php echo $_SESSION['YouTubeLink']; ?></td>
            </tr>
        </tbody>
    </table>
</div>