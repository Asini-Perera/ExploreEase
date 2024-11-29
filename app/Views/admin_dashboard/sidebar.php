<div class="sidebar">
    <ul>
        <li>
            <a href="?page=dashboard" class="<?= $mainContent == 'dashboard' ? 'active' : '' ?>">Dashboard</a>
        </li>
        <li>
            <a href="?page=verifyuser" class="<?= $mainContent == 'verifyuser' ? 'active' : '' ?>">Verify Users</a>
        </li>
        <li>
            <a href="?page=search" class="<?= $mainContent == 'search' ? 'active' : '' ?>">Search Users</a>
        </li>
        <li>
            <a href="?page=keyword" class="<?= $mainContent == 'keyword' ? 'active' : '' ?>">Manage Keywords</a>
        </li>
        <li>
            <a href="?page=verifykeyword" class="<?= $mainContent == 'verifykeyword' ? 'active' : '' ?>">Verify Keywords</a>
        </li>
        <li>
            <a href="?page=profile" class="<?= $mainContent == 'profile' ? 'active' : '' ?>">Profile</a>
        </li>
        <li>
            <a href="../admin/logout">Logout</a>
        </li>
    </ul>
</div>