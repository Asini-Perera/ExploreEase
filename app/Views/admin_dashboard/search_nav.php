<link rel="stylesheet" href="../public/css/admin_dashboard/search.css">
<link rel="stylesheet" href="../public/css/dashboard_templates/sub_nav.css">

<div class="search-container">
    <form action="#" method="GET">
        <input type="text" name="query" placeholder="Search Users..." required>
        <button class="search-btn" type="submit">Search</button>
    </form>  
</div>
<div class="navbar">
    <a href="?page=search&user=traveler" class="<?= $searchUser == 'traveler' ? 'active' : '' ?>">Traveler</a>
    <a href="?page=search&user=admin" class="<?= $searchUser == 'admin' ? 'active' : '' ?>">Admin</a>
    <a href="?page=search&user=restaurant" class="<?= $searchUser == 'restaurant' ? 'active' : '' ?>">Restaurant</a>
    <a href="?page=search&user=hotel" class="<?= $searchUser == 'hotel' ? 'active' : '' ?>">Hotel</a>
    <a href="?page=search&user=heritagemarket" class="<?= $searchUser == 'heritagemarket' ? 'active' : '' ?>">Heritage Market</a>
    <a href="?page=search&user=culturaleventorganizer" class="<?= $searchUser == 'culturaleventorganizer' ? 'active' : '' ?>">Cultural Event Organizer</a>
</div>