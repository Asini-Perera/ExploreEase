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
                <th>Actions</th>
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
                <td class="action-buttons">
                    <button class="reject-btn">Delete</button>
                </td>
            </tr> -->
            <?php if (empty($searchResults)) : ?>
                <tr>
                    <td colspan="6" class="no-results" style="text-align: center;">No results found.</td>
                </tr>
            <?php else: ?>
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
                        <td class="action-buttons">
                            <form method="post" action="../admin/verifyUser">
                                <input type="hidden" name="email" value="<?= htmlspecialchars($user['Email']) ?>">
                                <input type="hidden" name="userType" value="<?= htmlspecialchars($searchUser) ?>">
                                <input type="hidden" name="page" value="<?= htmlspecialchars($mainContent) ?>">
                                <input type="hidden" name="action" value="">
                                <button type="button" class="reject-btn">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<dialog id="openDialog">
    <p>Are you sure do you want to delete this user?</p>
    <div class="dialog-buttons">
        <button id="confirm" class="confirm-btn">Yes</button>
        <button id="cancel" class="cancel-btn">No</button>
    </div>
</dialog>

<script src="../public/js/admin_dashboard/search_user.js"></script>