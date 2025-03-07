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
                                <button class="verify-btn">Verify</button>
                                <button class="reject-btn">Reject</button>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>