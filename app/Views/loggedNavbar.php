 <link rel="stylesheet" type="text/css" href="/ExploreEase/public/css/loggedNavbar.css?v=1">
 <link rel="stylesheet" type="text/css" href="/ExploreEase/public/css/usermenue.css">
 <script src="/ExploreEase/public/js/usermenue.js"></script>


 <div class="navigation">
     <div class="wrapper">
         <nav class="navbar">
             <img class="logo" src="/ExploreEase/public/images/logo.png">
             <ul class="nav-list">
                 <li class="nav-item"><a href="http://localhost/ExploreEase/loged_home" class="nav-link">Home</a></li>
                 <li class="nav-item"><a href="#services-features" class="nav-link">Services</a></li>
                 <li class="nav-item"><a href="#about-us" class="nav-link">About Us</a></li>
                 <li class="nav-item"><a href="http://localhost/ExploreEase/Contactus" class="nav-link">Contact Us</a></li>

                 <li class="nav-item user-menu-container">
                     <a href="#" class="user-link" id="user-icon-link">
                         <img src="<?php echo htmlspecialchars($_SESSION['ImgPath'] ?? ''); ?>" alt="User Icon" class="user-icon" />
                     </a>
                     <div class="dropdown-menu" id="user-dropdown">
                         <a href="http://localhost/ExploreEase/TravellerDashboard">Dashboard</a>
                         <a href="/ExploreEase">Logout</a>
                     </div>
                 </li>

             </ul>


         </nav>
     </div>

 </div>

 <?php include_once __DIR__ . "/alert.php"; ?>