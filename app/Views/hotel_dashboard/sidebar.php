<div class="sidebar">
    <ul>
        <li>
            <a href="?page=dashboard" class="<?= $mainContent == 'dashboard' ? 'active' : '' ?>">Dashboard</a>
        </li>

        <li>
            <a href="?page=profile" class="<?= $mainContent == 'profile' ? 'active' : '' ?>">Profile</a>
        </li>

        <li>
            <a href="?page=room" class="<?= $mainContent == 'room' ? 'active' : '' ?>">Rooms</a>
        </li>

        <li>
            <a href="?page=post" class="<?= $mainContent == 'post' ? 'active' : '' ?>">Posts</a>
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