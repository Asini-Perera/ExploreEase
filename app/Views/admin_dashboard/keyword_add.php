<link rel="stylesheet" href="../public/css/admin_dashboard/keyword_add_delete.css">

<div class="form-content">

    <form action="../keyword/add" method="post">
        <?php
        // Display error message if failed to add keyword
        if (isset($_SESSION['error'])) {
            echo '<div class="error">' . htmlspecialchars($_SESSION['error']) . '</div>';
            unset($_SESSION['error']); // Clear the error message
        }

        // Display success message if keyword added successfully
        if (isset($_SESSION['success'])) {
            echo '<div class="success">' . htmlspecialchars($_SESSION['success']) . '</div>';
            unset($_SESSION['success']); // Clear the success message
        }
        ?>
        <label for="category">Category:</label>
        <input type="text" id="category" name="category" required><br><br>

        <label for="keyword">Keyword:</label>
        <input type="text" id="keyword" name="keyword" required><br><br>

        <button class="add" type="submit">Add Keyword</button>
    </form>
</div>