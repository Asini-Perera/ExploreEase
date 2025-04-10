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
                                    <button type="submit" name="action" value="verify" class="verify-btn">Verify</button>
                                    <button type="submit" name="action" value="reject" class="reject-btn">Reject</button>
                                </form>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>