<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>View Bookings</title>
  <link rel="stylesheet" href="/ExploreEase/public/css/travellerBooking.css?v=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php require_once __DIR__ . '/loggedNavbar.php'; ?>

  <section class="bookings-section">
    <h1>Your Bookings</h1>

    <div class="bookings-list">
      <?php if (empty($futureBookings) && empty($pastBookings)): ?>
        <p>No bookings found.</p>
      <?php else: ?>
        <?php foreach ($futureBookings as $futureBooking): ?>
          <div class="booking-card">
            <h2><?php echo htmlspecialchars($futureBooking['Name']); ?></h2>
            <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($futureBooking['BookingDate']); ?></p>
          </div>
        <?php endforeach; ?>

        <?php foreach ($pastBookings as $pastBooking): ?>
          <div class="booking-card">
            <h2><?php echo htmlspecialchars($pastBooking['Name']); ?></h2>
            <p><strong>Booking Date:</strong> <?php echo htmlspecialchars($pastBooking['BookingDate']); ?></p>
          </div>
        <?php endforeach; ?>
      <?php endif; ?>
      <!-- <div class="booking-card">
        <h2>ABC Hotel</h2>
        <p><strong>Booking Date:</strong> 15-May-2025</p>
        <p><strong>Room No:</strong> 2</p>
        <a href="#" class="view-details">View Details</a>
      </div>

      <div class="booking-card">
        <h2>Mountain Resort</h2>
        <p><strong>Booking Date:</strong> 20-May-2025</p>
        <p><strong>Table No:</strong> 3</p>
        <a href="#" class="view-details">View Details</a>
      </div>
     
      <div class="booking-card">
        <h2>City Hotel</h2>
        <p><strong>Booking Date:</strong> 25-May-2025</p>
        <p><strong>Room No:</strong> 5</p>
        <a href="#" class="view-details">View Details</a>
      </div>

       <div class="booking-card">
        <h2>ABC Hotel</h2>
        <p><strong>Booking Date:</strong> 15-May-2025</p>
        <p><strong>Room No:</strong> 2</p>
        <a href="#" class="view-details">View Details</a>
      </div>

      <div class="booking-card">
        <h2>Mountain Resort</h2>
        <p><strong>Booking Date:</strong> 20-May-2025</p>
        <p><strong>Table No:</strong> 3</p>
        <a href="#" class="view-details">View Details</a>
      </div>

      <div class="booking-card">
        <h2>City Hotel</h2>
        <p><strong>Booking Date:</strong> 25-May-2025</p>
        <p><strong>Room No:</strong> 5</p>
        <a href="#" class="view-details">View Details</a>
      </div> -->

    </div>

  </section>


</body>

</html>