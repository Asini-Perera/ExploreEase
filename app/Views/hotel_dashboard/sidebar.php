<div class="sidebar">
    <ul>
        <li>
            <a href="?page=dashboard" class="<?= $mainContent == 'dashboard' ? 'active' : '' ?>">Dashboard</a>
        </li>

        <li>
            <a href="?page=profile" class="<?= $mainContent == 'profile' ? 'active' : '' ?>">Profile</a>
        </li>

        <li>
            <a href="?page=room_list" class="<?= $mainContent == 'room_list' ? 'active' : '' ?>">Room List</a>
        </li>

        <li>
            <a href="?page=bookings" class="<?= $mainContent == 'bookings' ? 'active' : '' ?>">Bookings</a>
        </li>

        <li>
            <a href="?page=reviews" class="<?= $mainContent == 'reviews' ? 'active' : '' ?>">Reviews</a>
        </li>
        <li>
            <a href="../logout">Logout</a>
        </li>
    </ul>
</div>