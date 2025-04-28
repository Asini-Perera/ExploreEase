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
            <label for="service_provider">Partners* (Select multiple)</label>
            <select id="service_provider" name="partner_ids[]" multiple required size="6">
                <?php 
                    // Combine all service providers into one array
                    $allProviders = [];
                    
                    // Add hotels
                    if (!empty($hotels)) {
                        foreach ($hotels as $provider) {
                            $allProviders[] = [
                                'id' => $provider['HotelID'] ?? $provider['ID'],
                                'name' => $provider['HotelName'] ?? $provider['Name'],
                                'type' => 'hotel'
                            ];
                        }
                    }
                    
                    // Add restaurants
                    if (!empty($restaurants)) {
                        foreach ($restaurants as $provider) {
                            $allProviders[] = [
                                'id' => $provider['RestaurantID'] ?? $provider['ID'],
                                'name' => $provider['Name'],
                                'type' => 'restaurant'
                            ];
                        }
                    }
                    
                    // Add heritage markets
                    if (!empty($heritageMarkets)) {
                        foreach ($heritageMarkets as $provider) {
                            $allProviders[] = [
                                'id' => $provider['ShopID'] ?? $provider['ID'],
                                'name' => $provider['Name'],
                                'type' => 'heritagemarket'
                            ];
                        }
                    }
                    
                    // Add cultural events
                    if (!empty($culturalEvents)) {
                        foreach ($culturalEvents as $provider) {
                            $allProviders[] = [
                                'id' => $provider['OrganizerID'] ?? $provider['ID'],
                                'name' => $provider['Name'],
                                'type' => 'culturaleventorganizer'
                            ];
                        }
                    }
                    
                    // Sort providers alphabetically by name
                    usort($allProviders, function($a, $b) {
                        return strcmp($a['name'], $b['name']);
                    });
                    
                    // Output options
                    foreach ($allProviders as $provider) {
                        echo '<option value="' . $provider['id'] . '" data-type="' . $provider['type'] . '">' 
                           . htmlspecialchars($provider['name']) 
                           . ' (' . ucfirst($provider['type']) . ')'
                           . '</option>';
                    }
                ?>
            </select>
            <small>Hold Ctrl (or Cmd on Mac) to select multiple partners</small>
            
            <!-- Hidden input fields to store the type information -->
            <input type="hidden" id="selectedTypes" name="selectedTypes" value="">
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
        // Get all selected partners
        const selectElement = document.getElementById('service_provider');
        const selectedOptions = Array.from(selectElement.selectedOptions);
        
        if (selectedOptions.length === 0) {
            alert('Please select at least one partner.');
            return;
        }
        
        // Store the types of all selected partners
        const selectedTypes = {};
        selectedOptions.forEach(option => {
            const type = option.getAttribute('data-type');
            const id = option.value;
            if (!selectedTypes[type]) {
                selectedTypes[type] = [];
            }
            selectedTypes[type].push(id);
        });
        
        // Store the selected types in the hidden input
        document.getElementById('selectedTypes').value = JSON.stringify(selectedTypes);
        
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
</script>

</body>
</html>
