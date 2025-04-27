<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Traveller Dashboard</title>
  <link rel="stylesheet" href="public/css/service_traveller_side_view/TravellerDashboard.css?v=3">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php require_once __DIR__ . "/../loggedNavbar.php"; ?>

  <div class="dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="profile">
        <img src="public/images/user-icon-vector-png-6.png" alt="Profile Image" class="profile-img">
        <h3>Traveller Name</h3>
      </div>
      <nav class="sidebar-nav">
        <a href="#edit-profile">Edit Profile</a>
        <a href="#packages">Packages</a>
    
        <a href="#bookings">Bookings</a>
        <a href="#reviews">Reviews</a>
      </nav>
    </aside>

    <!-- Main Content -->
    <main class="main-content">
      <h1>Welcome, Traveller</h1>

      <section class="section" id="edit-profile">
        <h2>Edit Profile Details</h2>
        <form class="profile-form">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" placeholder="First Name">
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" placeholder="Last Name">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" placeholder="Email">
          </div>
          <div class="form-group">
            <label>Gender</label>
            <select>
              <option>Select</option>
              <option>Male</option>
              <option>Female</option>
            </select>
          </div>
          <div class="form-group">
            <label>Date of Birth</label>
            <input type="date">
          </div>
          <div class="form-group">
            <label>Contact Number</label>
            <input type="text" placeholder="Contact Number">
          </div>
          <div class="form-group">
            <label>Profile Image</label>
            <input type="file">
          </div>

          <button type="submit" class="btn-save">Save Changes</button>
        </form>
      </section>

      <!-- Packages Section -->
<section class="section" id="packages">
  <h2>Added Packages</h2>
  <div class="card-list">
    <div class="card">
      <h3>Cultural Triangle Tour</h3>
      <p>Sigiriya, Dambulla, Kandy - 4 Days</p>
    </div>
    <div class="card">
      <h3>Beach Relaxation</h3>
      <p>Mirissa & Unawatuna - 5 Days</p>
    </div>
    <div class="card">
      <h3>Hill Country Adventure</h3>
      <p>Ella & Nuwara Eliya - 3 Days</p>
    </div>

    <div class="card">
      <h3>Colombo City Escape</h3>
      <p>Colombo & Negombo - 2 Days</p>
    </div>
    <div class="card">
     <h3>Wildlife Safari</h3>
      <p>Yala National Park - 2 Days</p>
    </div>

  </div>
  <a href="http://localhost/ExploreEase/TravellerPackageList" class="btn-add">Click here to Add Packages</a>
</section>



<!-- Bookings Section -->
<section class="section" id="bookings">
  <h2>Bookings</h2>
  <div class="card-list">
    <div class="card">
      <h3>ABC Hotel</h3>
      <p>Booking Date: 15-May-2025</p>
      <p>Room No : 2 </p>
    </div>
    <div class="card">
      <h3>Mountain Resort</h3>
      <p>Booking Date: 20-May-2025</p>
      <p>Table No : 3 </p>

    </div>
  </div>
  <a href="http://localhost/ExploreEase/travllerBooking" class="btn-add">View Bookings</a>
</section>

<!-- Reviews Section -->
<section class="section" id="reviews">
  <h2>Reviews</h2>
  <div class="card-list">
    <div class="card">
      <h3>ABC Resort</h3>
      <div class="rating">
        ★★★★☆
      </div>
      <p>"Amazing experience!"</p>
    </div>
    <div class="card">
      <h3>ABC Restaurant</h3>
      <div class="rating">
        ★★★☆☆
      </div>
      <p>"Good food but service could improve."</p>
    </div>
  </div>
  
</section>



    </main>
  </div>
</body>
</html>
