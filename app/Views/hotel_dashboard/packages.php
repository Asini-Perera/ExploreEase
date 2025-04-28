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
        <a href="?page=packages&action=add" class="create-btn">Create Package</a>
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
        <a href="?page=packages&provider=traveler" class="<?= ($_GET['provider'] ?? '') == 'traveler' ? 'active' : '' ?>">Travelers</a>
    </div>

    <!-- Table View -->
    <table>
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
                case 'traveler':
                    $currentProviders = $travelers ?? [];
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

    <!-- Add JavaScript for handling request button clicks -->
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
        });
    </script>
</div>
</body>
</html>
