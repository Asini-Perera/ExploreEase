<?php
$page = isset($_GET['page']) ? $_GET['page'] : 'admin_main';
?>

<div class="sidebar">
    <ul>
        <li><a href="?page=dashboard" class="<?= $page == 'dashboard' ? 'active' : '' ?>">Dashboard</a></li>
        <li><a href="?page=verify" class="<?= $page == 'verify' ? 'active' : '' ?>">To Verify</a></li>
        <li><a href="?page=admin_admin" class="<?= $page == 'admin_admin' ? 'active' : '' ?>">Admin</a></li>
        <li><a href="?page=admin_traveler" class="<?= $page == 'admin_traveler' ? 'active' : '' ?>">Traveler</a></li>
        <li><a href="?page=admin_restaurant" class="<?= $page == 'admin_restaurant' ? 'active' : '' ?>">Restaurant</a></li>
    </ul>
</div>