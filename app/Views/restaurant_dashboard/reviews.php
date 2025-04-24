<link rel="stylesheet" href="../public/css/restaurant_dashboard/reviews.css">

<h1>Reviews</h1>

<div class="menu-container">
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
                    <td class="action-buttons">
                        <button class="reply-btn" id="sendReply" onclick="openPopup()">Reply</button>
                    </td>

                    <div class="popup" id="popup">
                    <div class="modal-content">
                        <form action="../../controllers/TableBookingController.php?action=sendTableNo" method="POST" id="tableNoForm">
                        <input type="hidden" name="review_id" id="reviewIdInput" value="<?= htmlspecialchars($feedback['FeedbackID']) ?>">
                        <span class="close-btn">&times;</span>

                        <h3>Add Reply</h3>
                        
                        <textarea placeholder="Add reply here" >

                        </textarea>
                        
                        <button type="submit" id="submitReply" onclick="closePopup()" >Ok</button>
                        </form>
                    </div>
                </tr>
            <?php endforeach; ?>
    
        <?php else: ?>
            <tr><td colspan="6">No reviews found.</td></tr>
        <?php endif; ?>  



        </tbody>
    </table>
</div>