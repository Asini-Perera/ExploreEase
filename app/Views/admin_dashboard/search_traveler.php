<link rel="stylesheet" href="../public/css/admin_dashboard/verify_user.css">

<div class="verify-container">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Gender</th>
                <th>Date of Birth</th>
                <th>Contact No</th>
            </tr>
        </thead>
        <tbody>
            <!-- <tr>
                <td class="profile-info">
                    <img src="../public/images/user.jpg" class="profile-img">
                    Amanda Perera
                </td>
                <td>amanda.perera@example.com</td>
                <td>Female</td>
                <td>1992-08-22</td>
                <td>+94 77 123 4567</td>
            </tr> -->
            <?php foreach ($searchResults as $user) : ?>
                <tr>
                    <td class="profile-info">
                        <img src="$user['ImgPath']" class="profile-img">
                        <?= htmlspecialchars($user['FirstName'] . ' ' . $user['LastName']) ?>
                    </td>
                    <td><?= htmlspecialchars($user['Email']) ?></td>
                    <td><?= htmlspecialchars($user['Gender'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($user['DOB'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($user['ContactNo'] ?? 'N/A') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>