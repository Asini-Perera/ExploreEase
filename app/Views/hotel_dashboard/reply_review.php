<link rel="stylesheet" href="../public/css/hotel_dashboard/reply_review.css">

<?php if (isset($_SESSION['error'])): ?>
    <div class="error-message">
        <?= $_SESSION['error']; ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="reply-review-card">
    <h2>Reply to Review</h2>
    <form action="../hotel/replyReview" method="POST">
        <!-- Add hidden input for review ID -->
        <input type="hidden" name="reviewID" value="<?php echo isset($_SESSION['ReviewID']) ? $_SESSION['ReviewID'] : ''; ?>">
        
        <div class="form-group">
            <label for="comment">Comment</label>
            <textarea id="comment" name="comment" rows="4" readonly><?php echo isset($_SESSION['Comment']) ? $_SESSION['Comment'] : ''; ?></textarea>
        </div>

        <div class="form-group">
            <label for="response">Response</label>
            <textarea id="response" name="response" rows="4" required><?php echo isset($_SESSION['Response']) ? $_SESSION['Response'] : ''; ?></textarea>
        </div>

        <div class="form-actions">
            <button type="submit" class="btn save-btn">Send</button>
            <button type="button" class="btn discard-btn" onclick="window.history.back()">Discard</button>
        </div>
    </form>
</div>