<link rel="stylesheet" href="../public/css/heritagemarket_dashboard/profile.css">

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
                <th>Email</th>
                <td><?php echo $_SESSION['Email']; ?></td>
            </tr>
            <tr>
                <th>Name</th>
                <td>J<?php echo $_SESSION['Name']; ?></td>
            </tr>
            
            <tr>
                <th>Address</th>
                <td><?php echo $_SESSION['Address']; ?></td>
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
                <th>Website</th>
                <td><?php echo $_SESSION['Website']; ?></td>
            </tr>
            <tr>
                <th>SM Link</th>
                <td><?php echo $_SESSION['SMLink']; ?></td>
            </tr>
            <tr>
                <th>OpenHours</th>
                <td><?php echo $_SESSION['OpenHours']; ?></td>
            </tr>
        </tbody>
    </table>
</div>