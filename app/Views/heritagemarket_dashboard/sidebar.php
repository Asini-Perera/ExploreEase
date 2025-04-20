<div class="sidebar">
    <ul>
        <li>
            <a href="?page=dashboard" class="<?= $mainContent == 'dashboard' ? 'active' : '' ?>"><i class="fa-solid fa-border-all"></i>Dashboard</a>
        </li>

        <li>
            <a href="?page=profile" class="<?= $mainContent == 'profile' ? 'active' : '' ?>"><i class="fa-solid fa-user"></i>Profile</a>
        </li>

        <li>
            <a href="?page=product" class="<?= $mainContent == 'product' ? 'active' : '' ?>"><i class="fa-solid fa-shopping-basket"></i>Products</a>
        </li>

        <li>
            <a href="?page=reviews" class="<?= $mainContent == 'reviews' ? 'active' : '' ?>"><i class="fa-solid fa-star"></i>Reviews</a>
        </li>

        <li>
            <a href="../logout"><i class="fa-solid fa-sign-out-alt"></i>Logout</a>
        </li>
    </ul>
</div>