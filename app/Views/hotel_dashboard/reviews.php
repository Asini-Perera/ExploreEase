<link rel="stylesheet" href="../public/css/hotel_dashboard/reviews.css">

<h1>Reviews</h1>

<div class="menu-container">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>

    <?php if (!isset($reviews)): ?>
        <div class="error-message">Error fetching reviews. Please try again later.</div>
    <?php else: ?>
        <table>
            <thead>
                <tr>
                    <th>Date</th>
                    <th>Rating</th>
                    <th>Comment</th>
                    <th>Response</th>
                    <th>Traveler</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($reviews)): ?>
                    <?php foreach ($reviews as $review): ?>
                        <tr>
                            <td><?= isset($review['Date']) ? $review['Date'] : 'N/A' ?></td>
                            <td><?= isset($review['Rating']) ? $review['Rating'] : 'N/A' ?></td>
                            <td><?= isset($review['Comment']) ? $review['Comment'] : 'N/A' ?></td>
                            <td><?= isset($review['Response']) ? $review['Response'] : 'N/A' ?></td>
                            <td><?= isset($review['FirstName']) && isset($review['LastName']) ? 
                                  $review['FirstName'] . ' ' . $review['LastName'] : 
                                  (isset($review['TravelerID']) ? $review['TravelerID'] : 'N/A') ?></td>
                            <td class="action-buttons">
                                <button class="reply-btn">
                                    <a href="?page=reviews&action=reply&id=<?= $review['FeedbackID'] ?>" style="color: white; text-decoration: none;">Reply</a>
                                </button>
                            </td>
                        </tr>
                    <?php endforeach; ?>        
                <?php else: ?>
                    <tr>
                        <td colspan="6" style="text-align: center; padding: 20px;">No reviews found</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>