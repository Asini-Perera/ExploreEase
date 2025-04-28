<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>View Reviews</title>
  <link rel="stylesheet" href="/ExploreEase/public/css/travellerReview.css?v=1">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>
  <?php require_once __DIR__ . '/loggedNavbar.php'; ?>

  <section class="reviews-section" id="reviews">
    <h1>Reviews</h1>
    <div class="reviews-list">
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


</body>

</html>