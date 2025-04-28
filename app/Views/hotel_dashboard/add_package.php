<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Create Package</title>
    <link rel="stylesheet" href="../public/css/hotel_dashboard/add_package.css">
</head>
<body>
<?php if(isset($_SESSION['error'])): ?>
    <div class="error-message">
        <?= $_SESSION['error'] ?>
        <?php unset($_SESSION['error']); ?>
    </div>
<?php endif; ?>

<div class="edit-booking-card">
    <h2>Create Partnership Package</h2>
    <form method="POST" action="?page=packages&action=create" id="packageForm">
        <div class="form-group">
            <label for="title">Package Title*</label>
            <input type="text" id="title" name="title" required>
        </div>

        <div class="form-group">
            <label for="description">Description</label>
            <input type="text" id="description" name="description">
        </div>

        <div class="form-group">
            <label for="provider_type">Service Provider Type*</label>
            <select id="provider_type" name="provider_type" required onchange="loadServiceProviders()">
                <option value="">Select Provider Type</option>
                <option value="hotel">Hotel</option>
                <option value="restaurant">Restaurant</option>
                <option value="cultural">Cultural Event</option>
                <option value="heritage">Heritage Market</option>
            </select>
        </div>

        <div class="form-group">
            <label for="service_provider">Service Provider*</label>
            <select id="service_provider" name="service_provider" required>
                <option value="">First select a provider type</option>
            </select>
        </div>
        
        <div class="form-group">
            <label for="discount">Discount Percentage*</label>
            <input type="number" id="discount" name="discount" min="1" max="100" required>
        </div>

        <div class="form-group">
            <label for="valid_from">Valid From*</label>
            <input type="date" id="valid_from" name="valid_from" required>
        </div>

        <div class="form-group">
            <label for="valid_to">Valid To*</label>
            <input type="date" id="valid_to" name="valid_to" required>
        </div>

        <div class="form-group">
            <label for="remarks">Remarks</label>
            <input type="text" id="remarks" name="remarks">
        </div>

        <div class="form-actions">
            <button type="button" class="btn save-btn">Create Package</button>
            <button type="button" class="btn cancel-btn" onclick="window.location.href='?page=packages'">Cancel</button>
        </div>
    </form>
</div>

<dialog id="openDialog">
    <p>Are you sure you want to create this package?</p>
    <div class="dialog-buttons">
        <button id="confirm" class="confirm-btn">Yes</button>
        <button id="cancel" class="cancel-btn">No</button>
    </div>
</dialog>

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Set minimum date for valid_from to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('valid_from').setAttribute('min', today);
    document.getElementById('valid_to').setAttribute('min', today);
    
    // Ensure valid_to is after valid_from
    document.getElementById('valid_from').addEventListener('change', function() {
        document.getElementById('valid_to').setAttribute('min', this.value);
    });
    
    // Dialog handling
    const dialog = document.getElementById('openDialog');
    const confirmButton = document.getElementById('confirm');
    const cancelButton = document.getElementById('cancel');
    const saveButton = document.querySelector('.save-btn');
    const form = document.getElementById('packageForm');

    saveButton.addEventListener('click', () => {
        dialog.showModal(); // Show the confirmation dialog
    });

    confirmButton.addEventListener('click', () => {
        dialog.close();
        form.submit(); // Submit the form when "Yes" is clicked
    });

    cancelButton.addEventListener('click', () => {
        dialog.close(); // Close the dialog on "No"
    });
});

function loadServiceProviders() {
    const providerType = document.getElementById('provider_type').value;
    const providerSelect = document.getElementById('service_provider');
    providerSelect.innerHTML = '<option value="">Loading providers...</option>';
    
    // Get providers based on type
    let providers = [];
    
    switch(providerType) {
        case 'hotel':
            providers = <?= json_encode($hotels ?? []) ?>;
            break;
        case 'restaurant':
            providers = <?= json_encode($restaurants ?? []) ?>;
            break;
        case 'cultural':
            providers = <?= json_encode($culturalEvents ?? []) ?>;
            break;
        case 'heritage':
            providers = <?= json_encode($heritageMarkets ?? []) ?>;
            break;
        default:
            providers = [];
    }
    
    // Populate dropdown
    providerSelect.innerHTML = '<option value="">Select a provider</option>';
    providers.forEach(provider => {
        const name = provider.HotelName || provider.Name;
        const id = provider.HotelID || provider.ID;
        const option = document.createElement('option');
        option.value = id;
        option.textContent = name;
        providerSelect.appendChild(option);
    });
}
</script>

</body>
</html>
