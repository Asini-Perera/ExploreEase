<link rel="stylesheet" href="../public/css/admin_dashboard/verify_keyword.css">

<div class="keyword-verification-content">
    <?php foreach ($serviceProviders as $serviceProvider) : ?>
        <div class="verification-item">
            <h2><?= htmlspecialchars($serviceProvider['Name']) ?></h2>
            <div class="verification-details">
                <?php foreach ($serviceProvider['categories'] as $category) : ?>
                    <div class="category-keywords">
                        <h3>Category: <?= htmlspecialchars($category['CategoryName']) ?></h3>
                        <?php foreach ($category['keywords'] as $keyword) : ?>
                            <div class="keyword-actions">
                                <p><?= htmlspecialchars($keyword['KName']) ?></p>
                                <form method="post" action="../keyword/verify">
                                    <input type="hidden" name="keyword" value="<?= htmlspecialchars($keyword['KeywordID']) ?>">
                                    <input type="hidden" name="userType" value="<?= htmlspecialchars($verifyKeyword) ?>">
                                    <?php if ($verifyKeyword === 'restaurant') : ?>
                                        <input type="hidden" name="serviceProvider" value="<?= htmlspecialchars($serviceProvider['RestaurantID']) ?>">
                                    <?php elseif ($verifyKeyword === 'hotel') : ?>
                                        <input type="hidden" name="serviceProvider" value="<?= htmlspecialchars($serviceProvider['HotelID']) ?>">
                                    <?php elseif ($verifyKeyword === 'heritagemarket') : ?>
                                        <input type="hidden" name="serviceProvider" value="<?= htmlspecialchars($serviceProvider['ShopID']) ?>">
                                    <?php elseif ($verifyKeyword === 'culturaleventorganizer') : ?>
                                        <input type="hidden" name="serviceProvider" value="<?= htmlspecialchars($serviceProvider['OrganizerID']) ?>">
                                    <?php endif; ?>
                                    <button type="button" name="action" value="verify" class="verify-btn">Verify</button>
                                    <button type="button" name="action" value="reject" class="reject-btn">Reject</button>
                                    <input type="hidden" name="action" value="">
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<dialog id="openDialog-verify">
    <p>Are you sure do you want to verify this keyword?</p>
    <div class="dialog-buttons">
        <button id="confirm-verify" class="confirm-btn">Yes</button>
        <button id="cancel-verify" class="cancel-btn">No</button>
    </div>
</dialog>

<dialog id="openDialog-reject">
    <p>Are you sure do you want to reject this keyword?</p>
    <div class="dialog-buttons">
        <button id="confirm-reject" class="confirm-btn">Yes</button>
        <button id="cancel-reject" class="cancel-btn">No</button>
    </div>
</dialog>

<script src="../public/js/admin_dashboard/verify_user.js"></script>