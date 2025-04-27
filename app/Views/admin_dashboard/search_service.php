<link rel="stylesheet" href="../public/css/admin_dashboard/verify_user.css">

<div class="verify-container">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Contact No</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <!-- <tr>
                <td>Ancient Artifacts</td>
                <td>info@ancientartifacts.lk</td>
                <td>No. 15, Heritage Road, Colombo, Sri Lanka</td>
                <td>+94 11 234 5678</td>
                <td class="action-buttons">
                    <button class="reject-btn">Delete</button>
                </td>
            </tr> -->
            <?php if (empty($searchResults)) : ?>
                <tr>
                    <td colspan="5" class="no-results" style="text-align: center;">No results found.</td>
                </tr>
            <?php else : ?>
                <?php foreach ($searchResults as $user) : ?>
                    <tr>
                        <td><?= htmlspecialchars($user['Name']) ?></td>
                        <td><?= htmlspecialchars($user['Email']) ?></td>
                        <td><?= htmlspecialchars($user['Address'] ?? 'N/A') ?></td>
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