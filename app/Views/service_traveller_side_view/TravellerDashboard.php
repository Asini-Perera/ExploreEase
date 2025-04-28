<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Traveller Dashboard</title>
  <link rel="stylesheet" href="public/css/service_traveller_side_view/TravellerDashboard.css?v=3">
  <link rel="icon" href="public/images/favicon.ico" type="image/x-icon">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php require_once __DIR__ . "/../loggedNavbar.php"; ?>

  <div class="dashboard">
    <!-- Sidebar -->
    <aside class="sidebar">
      <div class="profile">
        <img src="<?php echo htmlspecialchars($_SESSION['ImgPath'] ?? ''); ?>" alt="Profile Image" class="profile-img">
        <h3><?php echo htmlspecialchars($_SESSION['FirstName'] . ' ' . $_SESSION['LastName']); ?></h3>
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
      <h1>Welcome, <?php echo htmlspecialchars($_SESSION['FirstName']); ?></h1>

      <section class="section" id="edit-profile">
        <h2>Edit Profile Details</h2>
        <form class="profile-form" action="traveler/editProfile" method="post" enctype="multipart/form-data">
          <div class="form-group">
            <label>First Name</label>
            <input type="text" name="first_name" value="<?php echo htmlspecialchars($_SESSION['FirstName']); ?>" required>
          </div>
          <div class="form-group">
            <label>Last Name</label>
            <input type="text" name="last_name" value="<?php echo htmlspecialchars($_SESSION['LastName']); ?>" required>
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="email" name="email" value="<?php echo htmlspecialchars($_SESSION['Email']); ?>" required>
          </div>
          <div class="form-group">
            <label>Gender</label>
            <select name="gender" required>
              <option value="">Select</option>
              <option value="Male" <?php echo (isset($_SESSION['Gender']) && $_SESSION['Gender'] === 'Male') ? 'selected' : ''; ?>>Male</option>
              <option value="Female" <?php echo (isset($_SESSION['Gender']) && $_SESSION['Gender'] === 'Female') ? 'selected' : ''; ?>>Female</option>
            </select>
          </div>
          <div class="form-group">
            <label>Date of Birth</label>
            <input type="date" name="dob" value="<?php echo htmlspecialchars($_SESSION['DOB'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label>Contact Number</label>
            <input type="text" name="contact_number" value="<?php echo htmlspecialchars($_SESSION['ContactNo'] ?? ''); ?>">
          </div>
          <div class="form-group">
            <label>Profile Image</label>
            <input type="file" name="profile_image" accept="image/*">
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
        <a href="/add-package" class="btn-add">Click here to Add Packages</a>
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
          <?php if (empty($reviews)) : ?>
            <p>No reviews available.</p>
          <?php else : ?>
            <?php foreach ($reviews as $review) : ?>
              <div class="card">
                <h3><?php echo htmlspecialchars($review['Name']); ?></h3>
                <div class="rating">
                  <?php
                  $rating = (int)$review['Rating']; // Assuming 'Rating' is a number between 0 and 5
                  $stars = str_repeat('&#9733;', $rating) . str_repeat('&#9734;', 5 - $rating); // Filled and empty stars
                  ?>
                  <span class="stars"><?php echo $stars; ?></span>
                </div>
                <p><?php echo htmlspecialchars($review['Comment']); ?></p>
                <div class="response">
                  <p><?php echo htmlspecialchars($review['Response'] ?? 'No response available'); ?></p>
                </div>
              </div>
            <?php endforeach; ?>
          <?php endif; ?>
          <!-- <div class="card">
            <h3>ABC Resort</h3>
            <div class="rating">
              ★★★★☆
            </div>
            <p>"Amazing experience!"</p>
            <div class="response">
              <p>"Thank you for your feedback!"</p>
            </div>
          </div>
          <div class="card">
            <h3>ABC Restaurant</h3>
            <div class="rating">
              ★★★☆☆
            </div>
            <p>"Good food but service could improve."</p>
            <div class="response">
              <p>"Thank you for your feedback!"</p>
            </div>
          </div> -->
        </div>

      </section>



    </main>
  </div>
</body>

</html>