<link rel="stylesheet" href="../public/css/culturalevent_dashboard/reviews.css">

<h1>Reviews</h1>

<div class="reviews-container">
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
            <?php foreach ($reviews as $review) : ?>
                <tr>
                    <td><?= htmlspecialchars($review['Date']) ?></td>
                    <td><?= htmlspecialchars($review['Rating']) ?></td>
                    <td><?= htmlspecialchars($review['Comment']) ?></td>
                    <td>
                        <?php if (!empty($review['Response'])) : ?>
                            <?= htmlspecialchars($review['Response']) ?>
                        <?php else : ?>
                            <form id="response-form-<?= $review['FeedbackID'] ?>" action="../culturaleventorganizer/reviewResponse" method="POST" class="response-form" style="display:none;">
                                <input type="hidden" name="review_id" value="<?= $review['FeedbackID'] ?>">
                                <textarea name="response" placeholder="Type your response..." required></textarea>
                                <button type="submit" class="save-response-btn">Save</button>
                                <button type="button" class="cancel-response-btn" onclick="cancelResponse(<?= $review['FeedbackID'] ?>)">Cancel</button>
                            </form>
                        <?php endif; ?>
                    </td>
                    <td><?= htmlspecialchars($review['FirstName'] . ' ' . $review['LastName']) ?></td>
                    <td class="action-buttons">
                        <?php if (empty($review['Response'])) : ?>
                            <button class="reply-btn" onclick="showResponseForm(<?= $review['FeedbackID'] ?>)">Reply</button>
                        <?php endif; ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>

</div>