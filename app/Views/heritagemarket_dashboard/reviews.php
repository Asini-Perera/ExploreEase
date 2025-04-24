<link rel="stylesheet" href="../public/css/heritagemarket_dashboard/reviews.css">

<h1>Reviews</h1>

<div class="product-container">
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
                            <form id="response-form-<?= $review['FeedbackID'] ?>" action="../heritagemarket/reviewResponse" method="POST" class="response-form" style="display:none;">
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
            <!-- <tr>
                <td>2021-09-01</td>
                <td>5.0</td>
                <td>Great experience</td>
                <td>Thank you for your feedback</td>
                <td>John Doe</td>
                <td class="action-buttons">

                </td>
            </tr>
            <tr>
                <td>2021-09-05</td>
                <td>4.5</td>
                <td>Good service</td>
                <td></td>
                <td>Jane Doe</td>
                <td class="action-buttons">
                    <button class="reply-btn">Reply</button>
                </td>
            </tr>
            <tr>
                <td>2021-09-10</td>
                <td>5.0</td>
                <td>Excellent service</td>
                <td></td>
                <td>John Smith</td>
                <td class="action-buttons">
                    <button class="reply-btn">Reply</button>
                </td>
            </tr>
            <tr>
                <td>2021-09-15</td>
                <td>4.0</td>
                <td>Good experience</td>
                <td></td>
                <td>Jane Smith</td>
                <td class="action-buttons">
                    <button class="reply-btn">Reply</button>
                </td>
            </tr>
            <tr>
                <td>2021-09-20</td>
                <td>5.0</td>
                <td>Great service</td>
                <td>Thank you for your feedback</td>
                <td>John Doe</td>
                <td class="action-buttons">
                    
                </td>
            </tr> -->
        </tbody>
    </table>
</div>

<script src="../public/js/dashboard_templates/response_form.js"></script>