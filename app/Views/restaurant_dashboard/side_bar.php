<link rel="stylesheet" type="text/css" href="../public/css/restaurant_dashboard/admin.css">

<div class="side-bar">

        <div class="slide-bar-header" style="justify-items: center; margin-top:8vh;">
            <img src="../../../public/images/user-login-icon-11.jpg" style="height: 12vh; width: 7vw;">
            <h3 style="color: white;
    font-size: 24px;  ">Imesha Dias</h3>
        </div>
        <ul class="nav-bar">
            <!-- class="active" -->
            <li >
                <a href="?page=dashboard" class="<?= $mainContent == 'dashboard' ? 'active': '' ?>">Dashboard</a>
            </li>

            <li>
                <a href="?page=profile" class="<?= $mainContent == 'profile' ? 'active': '' ?>">Profile</a>
            </li>

            <li>
                <a href="?page=menu" class="<?= $mainContent == 'menu' ? 'active': '' ?>">Menu </a>
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

    <script>
    // Get the current page URL
    const currentPage = window.location.search;

    // Get all navigation links
    const navLinks = document.querySelectorAll('.nav-bar li a');

    // Loop through links and add 'active' class to the matching link
    navLinks.forEach(link => {
        if (link.getAttribute('href') === currentPage) {
            link.classList.add('active');
        }
    });
</script>
