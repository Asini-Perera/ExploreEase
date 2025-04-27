<link rel="stylesheet" href="../public/css/restaurant_dashboard/post_list.css">

<div class="post-container">
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
            <?php if (!empty($posts) && is_array($posts)): ?>
                <?php foreach ($posts as $post) : ?>
                    <tr>
                        <td><?= $post['Title'] ?></td>
                        <td><?= htmlspecialchars($post['Description']) ?></td>
                        <td> <?= date('d-m-Y', strtotime($post['Date'])) ?></td>
                        <td><img src="<?= $post['ImgPath'] ?>" class="post-img"></td>
                        <td class="action-buttons">
                            <button class="edit-btn"><a href="?page=post&action=edit&id=<?= $post['PostID'] ?>">Edit</a></button>
                            <button class="delete-btn" data-delete-url="?page=post&action=delete&id=<?= $post['PostID'] ?>">Delete</button>
                        </td>

                        <dialog id="deleteDialog">
                            <p>Are you sure you want to delete this post?</p>
                            <div class="dialog-buttons">
                                <button id="deleteConfirm" class="confirm-btn">Yes</button>
                                <button id="deleteCancel" class="cancel-btn">No</button>
                            </div>
                        </dialog>

                    </tr>

                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" style="text-align: center;">No posts found.</td>
                </tr>
            <?php endif; ?>

        </tbody>
    </table>
</div>


<script>
    const deleteDialog = document.getElementById('deleteDialog');
    const deleteButtons = document.querySelectorAll('.delete-btn');
    const confirmDelete = document.getElementById('deleteConfirm');
    const cancelDelete = document.getElementById('deleteCancel');

    let deleteUrl = '';

    deleteButtons.forEach(button => {
        button.addEventListener('click', () => {
            deleteUrl = button.getAttribute('data-delete-url');
            deleteDialog.showModal();
        });
    });

    confirmDelete.addEventListener('click', () => {
        deleteDialog.close();
        window.location.href = deleteUrl;
    });

    cancelDelete.addEventListener('click', () => {
        deleteDialog.close();
    });
</script>
