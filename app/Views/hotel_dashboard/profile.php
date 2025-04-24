<link rel="stylesheet" href="../public/css/hotel_dashboard/profile.css">

<div class="profile-container">
    <div class="top">
        <h1>Profile Details</h1>

        <div class="action-buttons">
            <a class="edit-btn" href="?page=profile&action=edit">Edit Profile</a>
            <a class="edit-btn" href="?page=profile&action=change-password">Change Password</a>
        </div>
    </div>

    <table>
        <tbody>
            <tr>
                <th>Email</th>
                <td><?php echo isset($_SESSION['Email']) ? $_SESSION['Email'] : ''; ?></td>
            </tr>

            <tr>
                <th>Name</th>
                <td><?php echo isset($_SESSION['Name']) ? $_SESSION['Name'] : ''; ?></td>
            </tr>

            <tr>
                <th>Address</th>
                <td><?php echo isset($_SESSION['Address']) ? $_SESSION['Address'] : ''; ?></td>
            </tr>
            <tr>
                <th>Contact No</th>
                <td><?php echo isset($_SESSION['ContactNo']) ? $_SESSION['ContactNo'] : ''; ?></td>
            </tr>
            <tr>
                <th>Description</th>
                <td><?php echo isset($_SESSION['Description']) ? $_SESSION['Description'] : ''; ?></td>
            </tr>
            <tr>
                <th>Website</th>
                <td><?php echo isset($_SESSION['Website']) ? $_SESSION['Website'] : ''; ?></td>
            </tr>
            <tr>
                <th>Tagline</th>
                <td><?php echo isset($_SESSION['Tagline']) ? $_SESSION['Tagline'] : ''; ?></td>
            </tr>
            <tr>
                <th>Facebook Link</th>
                <td><?php echo isset($_SESSION['FacebookLink']) ? $_SESSION['FacebookLink'] : ''; ?></td>
            </tr>
            <tr>
                <th>Instagram Link</th>
                <td><?php echo isset($_SESSION['InstagramLink']) ? $_SESSION['InstagramLink'] : ''; ?></td>
            </tr>
            <tr>
                <th>TikTok Link</th>
                <td><?php echo isset($_SESSION['TikTokLink']) ? $_SESSION['TikTokLink'] : ''; ?></td>
            </tr>
            <tr>
                <th>Youtube Link</th>
                <td><?php echo isset($_SESSION['YoutubeLink']) ? $_SESSION['YoutubeLink'] : ''; ?></td>
            </tr>
        </tbody>
    </table>
</div>