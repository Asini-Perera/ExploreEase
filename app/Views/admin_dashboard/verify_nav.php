
    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .navbar {
            overflow: hidden;
        }
        .navbar a {
            float: left;
            display: block;
            color: #225522;
            text-align: center;
            padding: 14px 16px;
            text-decoration: none;
        }
        .navbar a:hover {
            background-color: #ddd;
            color: black;
        }
        .navbar a.active {
            margin-bottom: 20px;
        }      
    </style>

<div class="navbar">
    <a href="?page=verify&user=admin" class="<?= $verifyUser == 'admin' ? 'active' : '' ?>">Admin</a>
    <a href="?page=verify&user=traveler" class="<?= $verifyUser == 'traveler' ? 'active' : '' ?>">Traveler</a>
    <a href="?page=verify&user=restaurant" class="<?= $verifyUser == 'restaurant' ? 'active' : '' ?>">Restaurant</a>
    <a href="?page=verify&user=hotel" class="<?= $verifyUser == 'hotel' ? 'active' : '' ?>">Hotel</a>
    <a href="?page=verify&user=heritagemarket" class="<?= $verifyUser == 'heritagemarket' ? 'active' : '' ?>">Heritage Market</a>
    <a href="?page=verify&user=culturaleventorganizer" class="<?= $verifyUser == 'culturaleventorganizer' ? 'active' : '' ?>">Cultural Event Organizer</a>
</div>
