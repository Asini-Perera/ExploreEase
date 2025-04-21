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
                    <td><?= $review['Date'] ?></td>
                    <td><?= $review['Rating'] ?></td>
                    <td><?= $review['Comment'] ?></td>
                    <td><?= $review['Response'] ?></td>
                    <td><?= $review['FirstName'] . ' ' . $review['LastName'] ?></td>
                    <td class="action-buttons">
                        <?php if (empty($review['Response'])) : ?>
                            <button class="reply-btn">Reply</button>
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