<div class="side-bar">

        <div class="slide-bar-header" style="justify-items: center; margin-top:8vh;">
            <img src="../../../public/images/user-login-icon-11.jpg" style="height: 12vh; width: 7vw;">
            <h3 style="color: white;
    font-size: 28px;  ">Imesha Dias</h3>
        </div>
        <ul class="nav-bar" style="position: fixed;">
            <!-- class="active" -->
            <li >
                <a href="?page=dashboard" class="<?= $mainContent == 'dashboard' ? 'active': '' ?>">Dashboard</a>
            </li>

            <li>
                <a href="?page=profile" class="<?= $mainContent == 'profile' ? 'active': '' ?>">Profile</a>
            </li>

            <li>
                <a href="?page=add_post" class="<?= $mainContent == 'add_post' ? 'active': '' ?>">Add Post </a>
            </li>

            <li>
                <a href="?page=post_list" class="<?= $mainContent == 'post_list' ? 'active': '' ?>">Post List</a>
            </li>

            <li>
                <a href="?page=bookings" class="<?= $mainContent == 'bookings' ? 'active': '' ?>">Bookings</a>
            </li>

            <li>
                <a href="?page=reviews" class="<?= $mainContent == 'reviews' ? 'active': '' ?>">Reviews</a>
            </li>

            <li class="logout">
                <a href="restaurant/logout">Log out</a>
            </li>
        </ul>      
    </div>
