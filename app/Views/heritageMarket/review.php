<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Submit Your Review</title>
    <link rel="stylesheet" href="../public/css/review/review.css">
    
</head>
<body>
    <?php require_once __DIR__ . '/../Navbar.php'; ?>
    <main>
        <h2 class="page-title">Submit Your Review</h2>
        <div class="review-form-container">
            <form action="../heritagemarket/submitReview" method="POST" class="review-form">
                <div class="form-group">
                    <label for="name">Name:</label>
                    <input type="text" id="name" name="name" required>
                </div>
                <div class="form-group">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="form-group">
                    <label for="rating">Rate Our Service (1-5):</label>
                    <select id="rating" name="rating" required>
                        <option value="" disabled selected>Select a rating</option>
                        <option value="1">1 - Poor</option>
                        <option value="2">2 - Fair</option>
                        <option value="3">3 - Good</option>
                        <option value="4">4 - Very Good</option>
                        <option value="5">5 - Excellent</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="review">Your Review:</label>
                    <textarea id="review" name="review" rows="5" required></textarea>
                </div>
                <button type="submit" class="submit-button">Submit Review</button>
            </form>
        </div>
    </main>
     
</body>
</html>
