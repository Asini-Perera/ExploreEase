<link rel="stylesheet" href="../public/css/admin_dashboard/search.css">
<link rel="stylesheet" href="../public/css/dashboard_templates/sub_nav.css">

<div class="search-container">
    <form method="GET">
        <input type="text" name="query" placeholder="Search Users using Names and Emails" value="<?= htmlspecialchars($_GET['query'] ?? '') ?>">
        <button class="search-btn" type="submit">Search</button>
        <input type="hidden" name="page" value="search">
        <input type="hidden" name="user" value="<?= htmlspecialchars($searchUser) ?>">
    </form>
</div>
<div class="navbar">
    <a href="?page=search&user=traveler&query=<?= urlencode($_GET['query'] ?? '') ?>" class="<?= $searchUser == 'traveler' ? 'active' : '' ?>">Traveler</a>
    <a href="?page=search&user=admin&query=<?= urlencode($_GET['query'] ?? '') ?>" class="<?= $searchUser == 'admin' ? 'active' : '' ?>">Admin</a>
    <a href="?page=search&user=restaurant&query=<?= urlencode($_GET['query'] ?? '') ?>" class="<?= $searchUser == 'restaurant' ? 'active' : '' ?>">Restaurant</a>
    <a href="?page=search&user=hotel&query=<?= urlencode($_GET['query'] ?? '') ?>" class="<?= $searchUser == 'hotel' ? 'active' : '' ?>">Hotel</a>
    <a href="?page=search&user=heritagemarket&query=<?= urlencode($_GET['query'] ?? '') ?>" class="<?= $searchUser == 'heritagemarket' ? 'active' : '' ?>">Heritage Market</a>
    <a href="?page=search&user=culturaleventorganizer&query=<?= urlencode($_GET['query'] ?? '') ?>" class="<?= $searchUser == 'culturaleventorganizer' ? 'active' : '' ?>">Cultural Event Organizer</a>
</div>