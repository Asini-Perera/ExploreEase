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
                        <button class="verify-btn">Verify</button>
                        <button class="reject-btn">Reject</button>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>