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
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td><?= htmlspecialchars($user['Name']) ?></td>
                    <td><?= htmlspecialchars($user['Email']) ?></td>
                    <td><?= htmlspecialchars($user['Address']) ?></td>
                    <td><?= htmlspecialchars($user['ContactNo']) ?></td>
                    <td class="action-buttons">
                        <form method="post" action="../admin/verifyUser">
                            <input type="hidden" name="email" value="<?= htmlspecialchars($user['Email']) ?>">
                            <input type="hidden" name="userType" value="<?= htmlspecialchars($verifyUser) ?>">
                            <button type="submit" name="action" value="verify" class="verify-btn">Verify</button>
                            <button type="submit" name="action" value="reject" class="reject-btn">Reject</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>