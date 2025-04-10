<link rel="stylesheet" href="../public/css/admin_dashboard/verify_user.css">

<div class="verify-container">
    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Email</th>
                <th>Address</th>
                <th>Contact No</th>
            </tr>
        </thead>
        <tbody>
            <!-- <tr>
                <td>Ancient Artifacts</td>
                <td>info@ancientartifacts.lk</td>
                <td>No. 15, Heritage Road, Colombo, Sri Lanka</td>
                <td>+94 11 234 5678</td>
            </tr> -->
            <?php foreach ($searchResults as $user) : ?>
                <tr>
                    <td><?= htmlspecialchars($user['Name']) ?></td>
                    <td><?= htmlspecialchars($user['Email']) ?></td>
                    <td><?= htmlspecialchars($user['Address'] ?? 'N/A') ?></td>
                    <td><?= htmlspecialchars($user['ContactNo'] ?? 'N/A') ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>