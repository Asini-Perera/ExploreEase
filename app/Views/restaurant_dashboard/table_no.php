<link rel="stylesheet" href="../public/css/restaurant_dashboard/edit_post.css">

<div class="form-content">
    <h1>Send table No</h1>
    <form method="POST" action="../tablebooking/sendTableNo" enctype="multipart/form-data">
        <input type="hidden" name="booking_ID" value="<?= htmlspecialchars($booking['BookingID']) ?>">

        <label for="table_no"> Table No</label>
        <input type="text" name="table_no" placeholder="add table no">

        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="submit" class="save-btn" onclick="">Save</button>     
        </div>

    </form>
</div>