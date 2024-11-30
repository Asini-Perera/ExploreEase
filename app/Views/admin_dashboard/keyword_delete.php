<link rel="stylesheet" href="../public/css/admin_dashboard/keyword_add_delete.css">

<div class="form-content">
    <form action="../keyword/delete" method="post">
        <?php
        // Display error message if failed to delete keyword
        if (isset($_SESSION['error'])) {
            echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']); // Clear the error message
        }

        // Display success message if keyword deleted successfully
        if (isset($_SESSION['success'])) {
            echo '<div class="success">' . htmlspecialchars($_SESSION['success']) . '</div>';
            unset($_SESSION['success']); // Clear the success message
        }
        ?>
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br><br>

        <label for="keyword">Keyword:</label>
        <input type="text" id="keyword" name="keyword" required><br><br>

        <button class="delete" type="submit">Delete Keyword</button>
    </form>
</div>