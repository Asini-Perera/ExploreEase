<link rel="stylesheet" href="../public/css/admin_dashboard/keyword_view.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">


<div class="keyword-content">
    <?php foreach ($categories as $category) : ?>
        <div class="categorytile" id="categorytile-<?= $category['CategoryID'] ?>">
            <h2><?= htmlspecialchars($category['CategoryName']) ?></h2>
            <div class="keywords">
                <?php foreach ($category['keywords'] as $keyword) : ?>
                    <div class="keyword-item">
                        <p><?= htmlspecialchars($keyword['KName']) ?></p>
                        <form action="../keyword/delete" method="POST" class="delete-form">
                            <input type="hidden" name="category" value="<?= $category['CategoryName'] ?>">
                            <input type="hidden" name="keyword" value="<?= $keyword['KName'] ?>">
                            <button type="submit" class="delete-btn">
                                <i class=" fa-solid fa-trash-can"></i>
                            </button>
                        </form>
                    </div>
                <?php endforeach; ?>

                <button class="add-keyword-btn" onclick="showForm(<?= $category['CategoryID'] ?>)">
                    <i class="fa-solid fa-plus"></i>
                </button>

                <form id="form-<?= $category['CategoryID'] ?>" action="../keyword/add" class="keyword-form" method="POST" style="display:none;">
                    <input type="hidden" name="category" value="<?= htmlspecialchars($category['CategoryName']) ?>">
                    <input type="text" name="keyword" placeholder="New Keyword" required>
                    <button type="submit" class="save-btn">Save</button>
                    <button type="button" class="cancel-btn" onclick="hideForm(<?= $category['CategoryID'] ?>)">Cancel</button>
                </form>
            </div>
        </div>
    <?php endforeach; ?>
</div>

<script src="../public/js/admin_dashboard/manage_keyword.js"></script>