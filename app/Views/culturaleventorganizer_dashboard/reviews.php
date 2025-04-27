<link rel="stylesheet" href="../public/css/culturalevent_dashboard/reviews.css">

<h1>Reviews</h1>

<div class="product-container">
    <?php if (isset($_SESSION['success'])): ?>
        <div class="success-message"><?= $_SESSION['success']; ?></div>
        <?php unset($_SESSION['success']); ?>
    <?php endif; ?>
    
    <?php if (isset($_SESSION['error'])): ?>
        <div class="error-message"><?= $_SESSION['error']; ?></div>
        <?php unset($_SESSION['error']); ?>
    <?php endif; ?>
    
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
                                <div style="margin-top: 10px;">
                                    <button type="submit" class="save-response-btn" style="background-color: #6fa857; color: white; border: none; border-radius: 4px; padding: 8px 12px; cursor: pointer; font-weight: bold; width: 100px;" >Save</button>
                                    <button type="button" class="cancel-response-btn" onclick="cancelResponse(<?= $review['FeedbackID'] ?>)" 
                                        style="background-color: #d9534f; color: white; border: none; border-radius: 4px; padding: 8px 12px; cursor: pointer; font-weight: bold; width: 100px;">Cancel</button>
                                </div>
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
    </table>
</div>

<script src="../public/js/dashboard_templates/response_form.js"></script>