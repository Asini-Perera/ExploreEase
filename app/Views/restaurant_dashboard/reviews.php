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
                <button class="reply-btn" id="openReply">Reply</button>
            </td>
        </tr>
    <?php endforeach; ?>
    
    <?php else: ?>
        <tr><td colspan="6">No reviews found.</td></tr>
    <?php endif; ?>  



        </tbody>
    </table>
</div>