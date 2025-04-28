<link rel="stylesheet" href="../public/css/culturalevent_dashboard/post_list.css">

<div class="-container">
    <div class="top">
            <h1>Post List</h1><span></span>

            <div class="action-buttons">
                <a class="add-btn" href="?page=post&action=add">Add Post</a>
            </div>
    </div>

    <table>
        <thead>
            <tr>
                <th>Title</th>
                <th>Description</th>
                <th>Date</th>
                <th>Image</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($posts as $post) : ?>
                <tr>
                <td><?= htmlspecialchars($post['Title']) ?></td>
                    <td><?= htmlspecialchars($post['Description']) ?></td>
                    <td><?= htmlspecialchars($post['Date']) ?></td>
                    <td data-label="Image">
                        <?php if (!empty($post['ImgPath'])): ?>
                            <img src="<?= htmlspecialchars($post['ImgPath']) ?>" class="post-img" alt="Post Image" style="width: 100px; height: 100px; object-fit: cover;">
                        <?php else: ?>
                            <img src="../public/images/default-post.png" class="post-img" alt="Default Post Image" style="width: 100px; height: 100px; object-fit: cover;">
                        <?php endif; ?>
                    </td>
                    <td data-label="Actions">
                        <div class="action-buttons">
                            <a href="?page=post&action=edit&id=<?= $post['PostID'] ?>" class="edit-btn">Edit</a>
                            <a href="?page=post&action=delete&id=<?= $post['PostID'] ?>" class="delete-btn">Delete</a>
                        </div>
                    </td>
                </tr>
            <?php endforeach; ?>
           
        </tbody>
    </table>
</div>