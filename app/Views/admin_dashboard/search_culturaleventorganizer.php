<link rel="stylesheet" href="../public/css/admin_dashboard/verify_user.css">

<div class="verify-container">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Contact No</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- <tr>
                <td class="profile-info">
                    <img src="../public/images/user.jpg" class="profile-img">
                    Kasun Perera
                </td>
                <td>kasun.perera@example.com</td>
                <td>+94 77 123 4567</td>
                <td class="action-buttons">
                    <button class="reject-btn">Delete</button>
                </td>
            </tr> -->
            <?php if (empty($searchResults)) : ?>
                <tr>
                    <td colspan="4" class="no-results" style="text-align: center;">No results found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($searchResults as $user) : ?>
                    <tr>
                        <td class="profile-info">
                            <img src="<?= htmlspecialchars($user['ImgPath']) ?>" class="profile-img">
                            <?= htmlspecialchars($user['Name']) ?>
                        </td>
                        <td><?= htmlspecialchars($user['Email']) ?></td>
                        <td><?= htmlspecialchars($user['ContactNo'] ?? 'N/A') ?></td>
                        <td class="action-buttons">
                            <form method="post" action="../admin/verifyUser">
                                <input type="hidden" name="email" value="<?= htmlspecialchars($user['Email']) ?>">
                                <input type="hidden" name="userType" value="<?= htmlspecialchars($searchUser) ?>">
                                <input type="hidden" name="page" value="<?= htmlspecialchars($mainContent) ?>">
                                <button type="submit" name="action" value="reject" class="reject-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>