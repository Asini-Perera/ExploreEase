<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Packages</title>
    <link rel="stylesheet" href="../public/css/hotel_dashboard/packages.css">
    <link rel="stylesheet" href="../public/css/admin_dashboard/search.css">
    <link rel="stylesheet" href="../public/css/dashboard_templates/sub_nav.css">
</head>
<body>
<div class="menu-container">
    <div class="top">
        <h1>Packages</h1>
        <div class="button-group">
            <a href="?page=packages&action=add" class="create-btn">Create New Package</a>
        </div>
    </div>

    <?php if(isset($_SESSION['success'])): ?>
        <div class="success-message">
            <?= $_SESSION['success'] ?>
            <?php unset($_SESSION['success']); ?>
        </div>
    <?php endif; ?>

    <?php if(isset($_SESSION['error'])): ?>
        <div class="error-message">
            <?= $_SESSION['error'] ?>
            <?php unset($_SESSION['error']); ?>
        </div>
    <?php endif; ?>

    <!-- Service Providers Section -->
    <div class="section-header">
        <h2>Available Service Providers</h2>
    </div>

    <div class="search-container">
        <form method="GET">
            <input type="text" name="query" placeholder="Search by name or email" value="<?= htmlspecialchars($_GET['query'] ?? '') ?>">
            <button class="search-btn" type="submit">Search</button>
            <input type="hidden" name="page" value="packages">
            <input type="hidden" name="provider" value="<?= htmlspecialchars($_GET['provider'] ?? 'hotel') ?>">
        </form>
    </div>

    <!-- Provider Navigation Tabs -->
    <div class="navbar">
        <a href="?page=packages&provider=hotel" class="<?= ($_GET['provider'] ?? 'hotel') == 'hotel' ? 'active' : '' ?>">Hotels</a>
        <a href="?page=packages&provider=restaurant" class="<?= ($_GET['provider'] ?? '') == 'restaurant' ? 'active' : '' ?>">Restaurants</a>
        <a href="?page=packages&provider=cultural" class="<?= ($_GET['provider'] ?? '') == 'cultural' ? 'active' : '' ?>">Cultural Events</a>
        <a href="?page=packages&provider=heritage" class="<?= ($_GET['provider'] ?? '') == 'heritage' ? 'active' : '' ?>">Heritage Markets</a>
    </div>

    <!-- Provider Table -->
    <table class="provider-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Email</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            // Determine which provider list to show based on tab
            $currentProviders = [];
            $providerType = $_GET['provider'] ?? 'hotel';
            
            switch($providerType) {
                case 'restaurant':
                    $currentProviders = $restaurants ?? [];
                    break;
                case 'cultural':
                    $currentProviders = $culturalEvents ?? [];
                    break;
                case 'heritage':
                    $currentProviders = $heritageMarkets ?? [];
                    break;
                case 'hotel':
                default:
                    $currentProviders = $hotels ?? [];
            }
            
            // Filter by search query if provided
            $query = $_GET['query'] ?? '';
            if (!empty($query) && !empty($currentProviders)) {
                $filteredProviders = [];
                foreach($currentProviders as $provider) {
                    $nameField = isset($provider['HotelName']) ? 'HotelName' : 'Name';
                    $name = $provider[$nameField] ?? '';
                    $email = $provider['Email'] ?? '';
                    
                    if (stripos($name, $query) !== false || stripos($email, $query) !== false) {
                        $filteredProviders[] = $provider;
                    }
                }
                $currentProviders = $filteredProviders;
            }
            
            if (!empty($currentProviders)): ?>
                <?php foreach($currentProviders as $provider): 
                    $providerName = isset($provider['HotelName']) ? $provider['HotelName'] : $provider['Name'];
                ?>
                    <tr>
                        <td><?= htmlspecialchars($providerName) ?></td>
                        <td><?= htmlspecialchars($provider['Address'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($provider['Phone'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($provider['Email'] ?? 'N/A') ?></td>
                        <td class="action-buttons">
                            <button class="request-btn" data-provider="<?= htmlspecialchars($providerName) ?>" data-email="<?= htmlspecialchars($provider['Email'] ?? '') ?>">
                                Request
                            </button>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="5" class="text-center">No providers found matching your criteria.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>
</div>

    <!-- My Packages Section -->
    <div class="section-header">
        <h2>My Packages</h2>
    </div>

    <?php if(empty($packages)): ?>
        <div class="empty-state">
            <p>You haven't created any packages yet.</p>
            <p>Create packages to offer special deals with other service providers.</p>
        </div>
    <?php else: ?>
        <div class="package-grid">
            <?php foreach($packages as $package): 
                // Determine package status
                $today = date('Y-m-d');
                $status = '';
                $statusClass = '';
                if ($package['EndDate'] < $today) {
                    $status = 'Expired';
                    $statusClass = 'expired';
                } elseif ($package['StartDate'] > $today) {
                    $status = 'Upcoming';
                    $statusClass = 'upcoming';
                } else {
                    $status = 'Active';
                    $statusClass = 'active';
                }
                
                // Default image if none provided
                $packageImage = !empty($package['ImgPath']) ? $package['ImgPath'] : '../public/images/default-package.jpg';
            ?>
                <div class="package-card">
                    <div class="package-image">
                        <img src="<?= $packageImage ?>" alt="<?= htmlspecialchars($package['Name']) ?>">
                        <span class="package-badge <?= $statusClass ?>"><?= $status ?></span>
                    </div>
                    <div class="package-content">
                        <h3><?= htmlspecialchars($package['Name']) ?></h3>
                        <p class="package-partner">
                            <strong>Partner:</strong> <?= htmlspecialchars($package['PartnerName']) ?>
                            <span class="partner-type">(<?= ucfirst($package['Owner']) ?>)</span>
                        </p>
                        <p class="package-discount"><strong>Discount:</strong> <?= htmlspecialchars($package['Discount']) ?>%</p>
                        <p class="package-validity"><strong>Valid:</strong> <?= date('M d, Y', strtotime($package['StartDate'])) ?> - <?= date('M d, Y', strtotime($package['EndDate'])) ?></p>
                        <p class="package-description"><?= nl2br(htmlspecialchars(substr($package['Description'], 0, 100))) ?><?= strlen($package['Description']) > 100 ? '...' : '' ?></p>
                        
                        <div class="package-actions">
                            <button class="delete-btn" data-id="<?= $package['PackageID'] ?>">Delete</button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>

    <!-- Package Users Section -->
    <div class="section-header">
        <h2>Package Users</h2>
    </div>

    <?php if(empty($packageUsers)): ?>
        <div class="empty-state">
            <p>No travelers have used your packages yet.</p>
            <p>When travelers use your packages, they will appear here.</p>
        </div>
    <?php else: ?>
        <table class="user-table">
            <thead>
                <tr>
                    <th>Traveler</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Package Used</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach($packageUsers as $user): ?>
                    <tr>
                        <td class="user-info">
                            <?php if(!empty($user['ImgPath'])): ?>
                                <img src="<?= $user['ImgPath'] ?>" alt="User" class="user-avatar">
                            <?php else: ?>
                                <div class="user-avatar-placeholder"><?= strtoupper(substr($user['FirstName'], 0, 1)) ?></div>
                            <?php endif; ?>
                            <?= htmlspecialchars($user['FirstName'] . ' ' . $user['LastName']) ?>
                        </td>
                        <td><?= htmlspecialchars($user['Email']) ?></td>
                        <td><?= htmlspecialchars($user['ContactNo'] ?? 'N/A') ?></td>
                        <td><?= htmlspecialchars($user['PackageName']) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

<!-- Dialog for package deletion -->
<dialog id="deleteDialog">
    <p>Are you sure you want to delete this package?</p>
    <div class="dialog-buttons">
        <button id="confirmDelete" class="confirm-btn">Yes, Delete</button>
        <button id="cancelDelete" class="cancel-btn">Cancel</button>
    </div>
</dialog>

<!-- Add JavaScript for handling actions -->
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Handle request button clicks
        const requestButtons = document.querySelectorAll('.request-btn');
        requestButtons.forEach(button => {
            button.addEventListener('click', function() {
                const providerName = this.getAttribute('data-provider');
                const providerEmail = this.getAttribute('data-email');
                
                // You can customize this to integrate with your actual request system
                alert(`Partnership request sent to ${providerName}. They will be notified via email at ${providerEmail}.`);
            });
        });

        // Handle delete button clicks
        const deleteButtons = document.querySelectorAll('.delete-btn');
        const dialog = document.getElementById('deleteDialog');
        const confirmBtn = document.getElementById('confirmDelete');
        const cancelBtn = document.getElementById('cancelDelete');
        let packageToDelete = null;

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                packageToDelete = this.getAttribute('data-id');
                dialog.showModal();
            });
        });

        confirmBtn.addEventListener('click', function() {
            if (packageToDelete) {
                window.location.href = `?page=packages&action=delete&id=${packageToDelete}`;
            }
            dialog.close();
        });

        cancelBtn.addEventListener('click', function() {
            packageToDelete = null;
            dialog.close();
        });
    });
</script>
</body>
</html>
