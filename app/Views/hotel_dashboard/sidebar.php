<div class="sidebar">
    <ul>
        <li>
            <a href="?page=dashboard" class="<?= $mainContent == 'dashboard' ? 'active' : '' ?>"><i class="fa-solid fa-border-all"></i>Dashboard</a>
        </li>

        <li>
            <a href="?page=profile" class="<?= $mainContent == 'profile' ? 'active' : '' ?>"><i class="fa-solid fa-user"></i>Profile</a>
        </li>

        <li>
            <a href="?page=room" class="<?= $mainContent == 'room' ? 'active' : '' ?>"><i class="fa-solid fa-bed"></i>Rooms</a>
        </li>

        <li>
            <a href="?page=post" class="<?= $mainContent == 'post' ? 'active' : '' ?>"><i class="fa-solid fa-pencil-alt"></i>Posts</a>
        </li>

        <li>
            <a href="?page=bookings" class="<?= $mainContent == 'bookings' ? 'active' : '' ?>"><i class="fa-solid fa-calendar-check"></i>Bookings</a>
        </li>

        <li>
            <a href="?page=reviews" class="<?= $mainContent == 'reviews' ? 'active' : '' ?>"><i class="fa-solid fa-star"></i>Reviews</a>
        </li>

        <li>
            <a href="../logout"><i class="fa-solid fa-sign-out-alt"></i>Logout</a>
        </li>
    </ul>
</div>