<!-- <link rel="stylesheet" href="/ExploreEase/public/css/TravellerPackageList.css?v=2"> -->

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

                            <li>🏨 Cinnamon Lodge</li>
                            <li>🍽️ Tropical Village Dining</li>
                            <li>🎭 Kandy Cultural Show</li>
                            <li>🛍️ Dambulla Heritage Market</li>

                        </ul>
                        <div class="price-location">
                            <span class="price"><?= number_format($package['Discount'], 2) ?>% OFF</span>
                        </div>
                        <div class="date-range"><strong>Valid:</strong> <?= $package['StartDate'] ?> - <?= $package['EndDate'] ?></div>
                        <div class="button-group">
                            <button type="button" name="action" value="verify" class="btn-action confirm-btn">Verify</button>
                            <button type="button" name="action" value="reject" class="btn-action cancel-btn">Reject</button>
                        </div>
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


<style>
    body {
        font-family: 'Poppins', sans-serif;
        background-color: #ddd;
        margin: 0;
        padding: 0;
    }

    .packages-section {
        padding: 60px 20px;
        max-width: 1300px;
        margin: auto;
    }


    .packages-list {
        display: grid;
        grid-template-columns: repeat(auto-fit, minmax(350px, 1fr));
        gap: 35px;
    }

    .package-card {
        background: #fff;
        border-radius: 10px;
        overflow: hidden;
        box-shadow: 0 8px 20px rgba(0, 0, 0, 0.15);
        transition: 0.4s ease;
        display: flex;
        flex-direction: column;
    }

    .package-card:hover {
        transform: translateY(-10px) scale(1.02);
    }

    .package-image {
        width: 100%;
        height: 230px;
        object-fit: cover;
        border-bottom: 2px solid rgba(34, 85, 34, 0.5);
    }

    .package-details {
        padding: 22px;
        flex: 1;
    }

    .package-details h2 {
        font-size: 22px;
        color: rgba(34, 85, 34, 0.933);
        margin-bottom: 12px;
    }

    .package-desc {
        font-size: 15px;
        color: #666;
        margin-bottom: 15px;
    }

    .services-included {
        list-style: none;
        padding: 0;
        margin-bottom: 18px;
    }

    .services-included li {
        margin-bottom: 8px;
        font-size: 14px;
    }

    .price-location {
        display: flex;
        justify-content: center;
        margin-bottom: 12px;
    }


    .price {
        background-color: rgba(34, 85, 34, 0.933);
        color: #fff;
        padding: 8px 16px;
        border-radius: 10px;
        font-weight: bold;
        font-size: 15px;
    }

    .date-range {
        font-size: 13px;
        color: #555;
        margin-bottom: 8px;
    }


    .button-group {
        display: flex;
        justify-content: space-between;
        gap: 10px;
        margin-top: 12px;
    }

    .btn-action {
        flex: none;
        width: 25%;
        text-align: center;
        padding: 8px;
        border-radius: 6px;
        text-decoration: none;
        color: white;
        font-weight: bold;
        transition: 0.3s ease;
        border: none;
    }

    .confirm-btn {
        background-color: #6fa857;
    }

    .cancel-btn {
        background-color: #d9534f;
    }

    .confirm-btn:hover {
        background-color: #225522;
    }

    .cancel-btn:hover {
        background-color: #c9302c;
    }
</style>