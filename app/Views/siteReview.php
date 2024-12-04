<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Leave a Review - ExploreEase</title>
    <link rel="stylesheet" href="public/css/siteReview.css?v=1">
    <link rel="stylesheet" href="../public/css/logedFooter.css?v=1">
    <link rel="stylesheet" href="../public/css/navbar.css?v=1">
</head>
<body>
    

    <main class="review-container">
        <section class="review-header">
            <h1>Share Your Experience</h1>
            <p>Your feedback helps us grow and improve!</p>
        </section>

        <form action="submit_review.php" method="POST" class="review-form">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" placeholder="Enter your name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" placeholder="Enter your email" required>
            </div>
            <div class="form-group">
                <label for="rating">Rating:</label>
                <div class="rating">
                    <input type="radio" id="star5" name="rating" value="5" required>
                    <label for="star5" title="5 stars">★</label>
                    <input type="radio" id="star4" name="rating" value="4">
                    <label for="star4" title="4 stars">★</label>
                    <input type="radio" id="star3" name="rating" value="3">
                    <label for="star3" title="3 stars">★</label>
                    <input type="radio" id="star2" name="rating" value="2">
                    <label for="star2" title="2 stars">★</label>
                    <input type="radio" id="star1" name="rating" value="1">
                    <label for="star1" title="1 star">★</label>
                </div>
            </div>
            <div class="form-group">
                <label for="comments">Comments:</label>
                <textarea id="comments" name="comments" placeholder="Share your thoughts..." rows="4" required></textarea>
            </div>
            <button type="submit" class="submit-button">Submit</button>
        </form>
    </main>

    
</body>
</html>
