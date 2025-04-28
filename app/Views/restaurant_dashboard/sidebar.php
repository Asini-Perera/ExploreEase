<div class="sidebar">
    <ul>
        <li>
            <a href="?page=dashboard" class="<?= $mainContent == 'dashboard' ? 'active' : '' ?>"><i class="fa-solid fa-border-all"></i>Dashboard</a>
        </li>

        <li>
            <a href="?page=profile" class="<?= $mainContent == 'profile' ? 'active' : '' ?>"><i class="fa-solid fa-user"></i>Profile</a>
        </li>

        <li>
            <a href="?page=menu" class="<?= $mainContent == 'menu' ? 'active' : '' ?>"><i class="fa-solid fa-utensils"></i>Menu List</a>
        </li>

        <li>
            <a href="?page=post" class="<?= $mainContent == 'post' ? 'active' : '' ?>"><i class="fa-solid fa-pencil-alt"></i>Post List</a>
        </li>

        <li>
            <a href="?page=bookings" class="<?= $mainContent == 'bookings' ? 'active' : '' ?>"><i class="fa-solid fa-list"></i>New Bookings</a>
        </li>

        <li>
            <a href="?page=booking_list" class="<?= $mainContent == 'booking_list' ? 'active' : '' ?>"><i class="fa-solid fa-calendar-check"></i>Bookings</a>
        </li>

        <li>
            <a href="?page=packages" class="<?= $mainContent == 'packages' ? 'active' : '' ?>"><i class="fa-solid fa-cubes"></i>Packages</a>
        </li>

        <li>
            <a href="?page=reviews" class="<?= $mainContent == 'reviews' ? 'active' : '' ?>"><i class="fa-solid fa-star"></i>Reviews</a>
        </li>

        <li>
            <a href="../logout"><i class="fa-solid fa-sign-out-alt"></i>Logout</a>
        </li>
    </ul>
</div>