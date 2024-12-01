<link rel="stylesheet" href="../public/css/culturalevent_dashboard/post_list.css">

<div class="menu-container">
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
                    <td><?= $post['Title'] ?></td>
                    <td><?= $post['Description'] ?></td>
                    <td><?= $post['Date'] ?></td>
                    <td><img src="<?= $post['ImgPath'] ?>" class="food-img"></td>
                    <td class="action-buttons">
                        <button class="edit-btn"><a href="?page=post&action=edit&id=<?= $post['PostID'] ?>">Edit</a></button>
                        <button class="delete-btn"><a href="?page=post&action=delete&id=<?= $post['PostID'] ?>">Delete</a></button>
                    </td>
                </tr>
            <?php endforeach; ?>
           
        </tbody>
    </table>
</div>