<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Keywords</title>
    <link rel="icon" href="../public/images/favicon.ico" type="image/x-icon">
    <link rel="stylesheet" href="../public/css/keyword.css">
</head>

<body>
    <div class="container">
        <div class="signup-box">
            <h2>Add Keywords</h2>
            <p>Select keywords according to your preferences. You can change them later.</p>

            <form action="../keyword/save" method="post">

                <?php foreach ($categories as $category) : ?>
                    <div class="input-group">
                        <label for="<?= $category['CategoryName'] ?>"><?= $category['CategoryName'] ?></label>
                        <div class="checkbox-group">
                            <?php foreach ($category['keywords'] as $keyword) : ?>
                                <label>
                                    <input type="checkbox" name="keywords[]" value="<?= $keyword['KeywordID'] ?>">
                                    <?= $keyword['KName'] ?>
                                </label>
                            <?php endforeach; ?>
                        </div>
                    </div>
                <?php endforeach; ?>

                <button type="submit">Save</button>
            </form>
        </div>
    </div>

    <script src="../public/js/background_slideshow2.js"></script>
</body>

</html>