<link rel="stylesheet" href="../public/css/admin_dashboard/verify_package.css">

<div class="packages-section">
    <div class="packages-list">

        <?php if (empty($packages)) : ?>
            <div class="no-packages-message">
                <h2>No packages available for verification.</h2>
            </div>
        <?php else : ?>
            <?php foreach ($packages as $package) : ?>
                <div class="package-card">
                    <img src="<?= $package['ImgPath'] ?>" alt="<?= $package['Name'] ?>" class="package-image">
                    <div class="package-details">
                        <h2><?= $package['Name'] ?></h2>
                        <p class="package-desc"><?= $package['Description'] ?></p>
                        <ul class="services-included">

                            <li>🏨 <?= $package['HotelName'] ?? '' ?></li>
                            <li>🍽️ <?= $package['RestaurantName'] ?? '' ?></li>
                            <li>🎭 <?= $package['EventName'] ?? '' ?></li>
                            <li>🛍️ <?= $package['HeritageMarketName'] ?? '' ?></li>

                        </ul>
                        <div class="price-location">
                            <span class="price"><?= number_format($package['Discount'], 2) ?>% OFF</span>
                        </div>
                        <div class="date-range"><strong>Valid:</strong> <?= $package['StartDate'] ?> - <?= $package['EndDate'] ?></div>
                        <form method="post" action="../admin/verifyPackage">
                            <input type="hidden" name="package_id" value="<?= $package['PackageID'] ?>">
                            <div class="button-group">
                                <button type="button" name="action" value="verify" class="btn-action verify-btn">Verify</button>
                                <button type="button" name="action" value="reject" class="btn-action reject-btn">Reject</button>
                                <input type="hidden" name="action" value="">
                            </div>
                        </form>
                    </div>
                </div>

            <?php endforeach; ?>
        <?php endif; ?>


        <!-- <div class="package-card">
            <img src="/ExploreEase/public/images/sigiriya.jpg" alt="Sigiriya Adventure" class="package-image">
            <div class="package-details">
                <h2>Sigiriya & Cultural Triangle Tour</h2>
                <p class="package-desc">3-day exploration of Sri Lanka’s ancient kingdoms and heritage sites.</p>
                <ul class="services-included">
                    <li>🏨 Cinnamon Lodge</li>
                    <li>🍽️ Tropical Village Dining</li>
                    <li>🎭 Kandy Cultural Show</li>
                    <li>🛍️ Dambulla Heritage Market</li>
                </ul>
                <div class="price-location">
                    <span class="price">LKR 35,000</span>
                </div>
                <div class="date-range"><strong>Valid:</strong> May 1 - Sep 30, 2025</div>
                <div class="button-group">
                    <a href="#" class="btn-action confirm-btn">Verify</a>
                    <a href="#" class="btn-action cancel-btn">Reject</a>
                </div>
            </div>
        </div> -->

    </div>
</div>

<dialog id="openDialog-verify">
    <p>Are you sure do you want to verify this package?</p>
    <div class="dialog-buttons">
        <button id="confirm-verify" class="confirm-btn">Yes</button>
        <button id="cancel-verify" class="cancel-btn">No</button>
    </div>
</dialog>

<dialog id="openDialog-reject">
    <p>Are you sure do you want to reject this package?</p>
    <div class="dialog-buttons">
        <button id="confirm-reject" class="confirm-btn">Yes</button>
        <button id="cancel-reject" class="cancel-btn">No</button>
    </div>
</dialog>

<script src="../public/js/admin_dashboard/verify_user.js"></script>