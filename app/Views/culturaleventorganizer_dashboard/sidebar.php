<div class="sidebar">
    <ul>
        <li>
            <a href="?page=dashboard" class="<?= $mainContent == 'dashboard' ? 'active' : '' ?>"><i class="fa-solid fa-border-all"></i>Dashboard</a>
        </li>

        <li>
            <a href="?page=profile" class="<?= $mainContent == 'profile' ? 'active' : '' ?>"><i class="fa-solid fa-user"></i>Profile</a>
        </li>

        <li>
            <a href="?page=event" class="<?= $mainContent == 'event' ? 'active' : '' ?>"><i class="fa-solid fa-calendar"></i>Event List</a>
        </li>

        <li>
            <a href="?page=bookings" class="<?= $mainContent == 'bookings' ? 'active' : '' ?>"><i class="fa-solid fa-book"></i>Bookings</a>
        </li>

        <li>
            <a href="?page=reviews" class="<?= $mainContent == 'reviews' ? 'active' : '' ?>"><i class="fa-solid fa-star"></i>Reviews</a>
        </li>

        <li>
            <a href="?page=images" class="<?= $mainContent == 'images' ? 'active' : '' ?>"><i class="fa-solid fa-images"></i>Images</a>
        </li>

        <li>
            <a href="../logout"><i class="fa-solid fa-sign-out-alt"></i>Logout</a>
        </li>
    </ul>
</div>