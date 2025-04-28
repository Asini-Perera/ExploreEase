<div class="sidebar">
    <ul>
        <li>
            <a href="?page=dashboard" class="<?= $mainContent == 'dashboard' ? 'active' : '' ?>"><i class="fa-solid fa-border-all"></i>Dashboard</a>
        </li>

        <li>
            <a href="?page=verifyuser" class="<?= $mainContent == 'verifyuser' ? 'active' : '' ?>"><i class="fa-solid fa-user-check"></i>Verify Users</a>
        </li>

        <li>
            <a href="?page=search" class="<?= $mainContent == 'search' ? 'active' : '' ?>"><i class="fa-solid fa-search"></i>Search Users</a>
        </li>

        <li>
            <a href="?page=viewkeyword" class="<?= $mainContent == 'viewkeyword' ? 'active' : '' ?>"><i class="fa-solid fa-keyboard"></i>Manage Keywords</a>
        </li>

        <li>
            <a href="?page=verifykeyword" class="<?= $mainContent == 'verifykeyword' ? 'active' : '' ?>"><i class="fa-solid fa-check-circle"></i>Verify Keywords</a>
        </li>

        <li>
            <a href="?page=verifypackage" class="<?= $mainContent == 'verifypackage' ? 'active' : '' ?>"><i class="fa-solid fa-box"></i>Verify Packages</a>
        </li>

        <li>
            <a href="?page=profile" class="<?= $mainContent == 'profile' ? 'active' : '' ?>"><i class="fa-solid fa-user"></i>Profile</a>
        </li>

        <li>
            <a href="../admin/logout"><i class="fa-solid fa-sign-out-alt"></i>Logout</a>
        </li>
    </ul>
</div>