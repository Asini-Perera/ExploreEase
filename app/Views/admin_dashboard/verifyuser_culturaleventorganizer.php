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
                    Nuwan Samarasinghe
                </td>
                <td>nuwan.samarasinghe@example.com</td>
                <td>+94 77 345 6789</td>
                <td class="action-buttons">
                    <button class="verify-btn">Verify</button>
                    <button class="reject-btn">Reject</button>
                </td>
            </tr> -->
            <?php if (empty($users)) : ?>
                <tr>
                    <td colspan="4" class="no-results" style="text-align: center;">No results found.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($users as $user) : ?>
                    <tr>
                        <td class="profile-info">
                            <img src="<?= htmlspecialchars($user['ImgPath']) ?>" class="profile-img">
                            <?= htmlspecialchars($user['Name']) ?>
                        </td>
                        <td><?= htmlspecialchars($user['Email']) ?></td>
                        <td><?= htmlspecialchars($user['ContactNo']) ?></td>
                        <td class="action-buttons">
                            <form method="post" action="../admin/verifyUser">
                                <input type="hidden" name="email" value="<?= htmlspecialchars($user['Email']) ?>">
                                <input type="hidden" name="userType" value="<?= htmlspecialchars($verifyUser) ?>">
                                <input type="hidden" name="page" value="<?= htmlspecialchars($mainContent) ?>">
                                <input type="hidden" name="name" value="<?= htmlspecialchars($user['Name']) ?>">
                                <button type="button" name="action" value="verify" class="verify-btn">Verify</button>
                                <button type="button" name="action" value="reject" class="reject-btn">Reject</button>
                                <input type="hidden" name="action" value="">
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<dialog id="openDialog-verify">
    <p>Are you sure do you want to verify this user?</p>
    <div class="dialog-buttons">
        <button id="confirm-verify" class="confirm-btn">Yes</button>
        <button id="cancel-verify" class="cancel-btn">No</button>
    </div>
</dialog>

<dialog id="openDialog-reject">
    <p>Are you sure do you want to reject this user?</p>
    <div class="dialog-buttons">
        <button id="confirm-reject" class="confirm-btn">Yes</button>
        <button id="cancel-reject" class="cancel-btn">No</button>
    </div>
</dialog>

<script src="../public/js/admin_dashboard/verify_user.js"></script>