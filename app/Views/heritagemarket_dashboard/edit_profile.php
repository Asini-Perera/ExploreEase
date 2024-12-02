<link rel="stylesheet" href="../public/css/heritagemarket_dashboard/edit_profile.css">

<div class="profile-container">
    <h1>Edit Profile Details</h1>
    
    <form id="edit-profile-form" action="../heritage/update" method="POST">
        
        <div class="form-group">
            <label for="email">Email</label>
            <input type="email" id="email" name="email" placeholder="Enter email">
        </div>
        <div class="form-group">
            <label for="name">Name</label>
            <input type="text" id="name" name="name" placeholder="Enter name">
        </div>
        <div class="form-group">
            <label for="address">Address</label>
            <input type="text" id="address" name="address" placeholder="Enter address">
        </div>
        <div class="form-group">
            <label for="contact_no">Contact No</label>
            <input type="text" id="contact_no" name="contact_no" placeholder="Enter contact no">
        </div>
        <div class="form-group">
            <label for="description">Description</label>
            <textarea id="description" name="description" placeholder="Enter description"></textarea>
        </div>
        <div class="form-group">
            <label for="website">Website</label>
            <input type="text" id="website" name="website" placeholder="Enter website">
        </div>
        <div class="form-group">
            <label for="sm_link">SMLink</label>
            <input type="text" id="sm_link" name="sm_link" placeholder="Enter SMLink">
        </div>
        <div class="form-group">
            <label for="open_hours">OpenHours</label>
            <input type="text" id="open_hours" name="open_hours" placeholder="Enter open hours">
        </div>
        
        <div class="action-buttons">
            <button type="button" class="discard-btn" onclick="window.history.back()">Discard</button>
            <button type="submit" class="save-btn" onclick="">Save</button>     
        </div>
        
    </form>
</div>

<!-- <script>
function toggleEditForm() {
    var form = document.getElementById('edit-profile-form');
    if (form.style.display === 'none') {
        form.style.display = 'block';
    } else {
        form.style.display = 'none';
    }
}
</script> -->