<link rel="stylesheet" href="../public/css/restaurant_dashboard/reviews.css">

<h1>Reviews</h1>

<div class="reviews-container">

    <table>
        <thead>
            <tr>
                <th>Name</th>
                <th>Date</th>
                <th>Rating</th>
                <th>Feedback</th>
                <th>Response</th>
                <th>Actions</th>
            </tr>
        </thead>

        <tbody>
            <?php if (!empty($reviews) && is_array($reviews)): ?>
                <?php foreach ($reviews as $feedback): ?>
                    <tr>
                       <td><?= htmlspecialchars($feedback['FirstName'].' '. $feedback['LastName']) ?></td>
                    <td><?= date('d-m-Y', strtotime($feedback['Date'])) ?></td>
                    <td><?= htmlspecialchars($feedback['Rating']) ?></td>
                    <td><?= nl2br(htmlspecialchars($feedback['Comment'])) ?></td>
                    <td><?= htmlspecialchars($feedback['Response']) ?></td>
                    <td class="action-buttons" onclick="openReplyDialog('<?= htmlspecialchars($feedback['Comment'], ENT_QUOTES) ?>', <?= $feedback['FeedbackID'] ?>)">
                        <button class="reply-btn"> 
                            Reply  
                             
                        </button>
                    </td>

                    <dialog id="replyDialog">
                        <form method="POST" id="replyForm" action="?page=reviews&action=reply">
                            <p><strong>Comment </strong></p>
                            <textarea id="originalComment" readonly></textarea>

                            <p><strong>Reply </strong></p>
                            <textarea name="reply" class="reply" required></textarea>

                            <input type="hidden" name="reviewID" id="review_id">

                            <div style="margin-top: 10px; text-align: right;">
                                <button type="submit" class="confirm-btn">Submit</button>
                                <button type="button" class="cancel-btn" onclick="document.getElementById('replyDialog').close()">Cancel</button>
                            </div>
                        </form>
                    </dialog>
                    </tr>
                <?php endforeach; ?>

            <?php else: ?>
                <tr>

                    <td colspan="6" style="text-align: center;">No reviews found.</td>

                </tr>
            <?php endif; ?>



        </tbody>
    </table> 
</div>

<script>
    function openReplyDialog(comment, feedbackId) {
        const dialog = document.getElementById('replyDialog');
        document.getElementById('originalComment').value = comment;
        document.getElementById('review_id').value = feedbackId;
        dialog.showModal();
    }
</script>