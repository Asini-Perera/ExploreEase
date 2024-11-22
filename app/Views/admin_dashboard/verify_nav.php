<link rel="stylesheet" href="../public/css/admin_dashboard/sub_nav.css">

<div class="navbar">
    <a href="?page=verify&user=admin" class="<?= $verifyUser == 'admin' ? 'active' : '' ?>">Admin</a>
    <a href="?page=verify&user=restaurant" class="<?= $verifyUser == 'restaurant' ? 'active' : '' ?>">Restaurant</a>
    <a href="?page=verify&user=hotel" class="<?= $verifyUser == 'hotel' ? 'active' : '' ?>">Hotel</a>
    <a href="?page=verify&user=heritagemarket" class="<?= $verifyUser == 'heritagemarket' ? 'active' : '' ?>">Heritage Market</a>
    <a href="?page=verify&user=culturaleventorganizer" class="<?= $verifyUser == 'culturaleventorganizer' ? 'active' : '' ?>">Cultural Event Organizer</a>
</div>
