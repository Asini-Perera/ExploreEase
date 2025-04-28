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
    <form method="POST" action="?page=packages&action=create" id="packageForm" enctype="multipart/form-data">
        <div class="form-group">
            <label for="name">Package Name*</label>
            <input type="text" id="name" name="name" required>
        </div>

        <div class="form-group">
            <label for="description">Description*</label>
            <textarea id="description" name="description" rows="3" required></textarea>
        </div>

        <div class="form-group">
            <label for="provider_type">Partner Type*</label>
            <select id="provider_type" name="owner" required onchange="loadServiceProviders()">
                <option value="">Select Partner Type</option>
                <option value="hotel">Hotel</option>
                <option value="restaurant">Restaurant</option>
                <option value="heritagemarket">Heritage Market</option>
                <option value="culturaleventorganizer">Cultural Event</option>
            </select>
        </div>

        <div class="form-group">
            <label for="service_provider">Partner*</label>
            <select id="service_provider" name="partner_id" required>
                <option value="">First select a partner type</option>
            </select>
            <!-- Hidden input fields to store the specific IDs -->
            <input type="hidden" id="hotelID" name="hotelID" value="">
            <input type="hidden" id="restaurantID" name="restaurantID" value="">
            <input type="hidden" id="shopID" name="shopID" value="">
            <input type="hidden" id="eventID" name="eventID" value="">
        </div>
        
        <div class="form-group">
            <label for="discount">Discount Percentage*</label>
            <input type="number" id="discount" name="discount" min="1" max="100" required>
        </div>

        <div class="form-group">
            <label for="startDate">Valid From*</label>
            <input type="date" id="startDate" name="startDate" required>
        </div>

        <div class="form-group">
            <label for="endDate">Valid To*</label>
            <input type="date" id="endDate" name="endDate" required>
        </div>

        <div class="form-group">
            <label for="packageImage">Package Image</label>
            <input type="file" id="packageImage" name="packageImage" accept="image/*">
            <small>Choose an image to represent this package (optional)</small>
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
    // Set minimum date for startDate to today
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('startDate').setAttribute('min', today);
    document.getElementById('endDate').setAttribute('min', today);
    
    // Ensure endDate is after startDate
    document.getElementById('startDate').addEventListener('change', function() {
        document.getElementById('endDate').setAttribute('min', this.value);
    });
    
    // Dialog handling
    const dialog = document.getElementById('openDialog');
    const confirmButton = document.getElementById('confirm');
    const cancelButton = document.getElementById('cancel');
    const saveButton = document.querySelector('.save-btn');
    const form = document.getElementById('packageForm');

    saveButton.addEventListener('click', () => {
        // Clear all hidden ID fields
        document.getElementById('hotelID').value = '';
        document.getElementById('restaurantID').value = '';
        document.getElementById('shopID').value = '';
        document.getElementById('eventID').value = '';
        
        // Set the appropriate ID field based on partner type
        const partnerId = document.getElementById('service_provider').value;
        const partnerType = document.getElementById('provider_type').value;
        
        if (partnerId && partnerType) {
            switch(partnerType) {
                case 'hotel':
                    document.getElementById('hotelID').value = partnerId;
                    break;
                case 'restaurant':
                    document.getElementById('restaurantID').value = partnerId;
                    break;
                case 'heritagemarket':
                    document.getElementById('shopID').value = partnerId;
                    break;
                case 'culturaleventorganizer':
                    document.getElementById('eventID').value = partnerId;
                    break;
            }
            dialog.showModal(); // Show the confirmation dialog
        } else {
            alert('Please select a partner type and a specific partner.');
        }
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
    providerSelect.innerHTML = '<option value="">Loading partners...</option>';
    
    // Get providers based on type
    let providers = [];
    
    switch(providerType) {
        case 'hotel':
            providers = <?= json_encode($hotels ?? []) ?>;
            break;
        case 'restaurant':
            providers = <?= json_encode($restaurants ?? []) ?>;
            break;
        case 'culturaleventorganizer':
            providers = <?= json_encode($culturalEvents ?? []) ?>;
            break;
        case 'heritagemarket':
            providers = <?= json_encode($heritageMarkets ?? []) ?>;
            break;
        default:
            providers = [];
    }
    
    // Populate dropdown
    providerSelect.innerHTML = '<option value="">Select a partner</option>';
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
