<link rel="stylesheet" href="../public/css/admin_dashboard/keyword_view.css">

<div class="keyword-content">

    <?php foreach ($categories as $category) : ?>
        <div class="categorytile">
            <h2><?= $category['CategoryName'] ?></h2>
            <div class="keywords">
                <?php foreach ($category['keywords'] as $keyword) : ?>
                    <p><?= $keyword['KName'] ?></p>
                <?php endforeach; ?>
            </div>
        </div>
    <?php endforeach; ?>

</div>