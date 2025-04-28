<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Service Providers</title>
    <link rel="stylesheet" href="../public/css/hotel_dashboard/packages.css">
</head>
<body>
<div class="menu-container">
    <div class="top">
        <h1>Service Provider Packages</h1>
    </div>

    <!-- View Toggle Buttons -->
    <div class="view-toggle">
        <button class="active" id="card-view-btn">Card View</button>
        <button id="table-view-btn">Table View</button>
    </div>

    <!-- Hotels Section -->
    <h2 class="section-header">Hotels</h2>
    
    <!-- Card View (Default) -->
    <div class="provider-grid" id="hotels-card-view">
        <?php if (!empty($hotels)): ?>
            <?php foreach($hotels as $hotel): ?>
                <div class="provider-card">
                    <div class="card-header hotel"><?= htmlspecialchars($hotel['HotelName']) ?></div>
                    <div class="card-body">
                        <div class="provider-info">
                            <p><span class="label">Location:</span> <?= htmlspecialchars($hotel['Address']) ?></p>
                            <p><span class="label">Phone:</span> <?= htmlspecialchars($hotel['Phone']) ?></p>
                            <p><span class="label">Email:</span> <?= htmlspecialchars($hotel['Email']) ?></p>
                        </div>
                        <div class="action-buttons">
                            <a href="mailto:<?= htmlspecialchars($hotel['Email']) ?>" class="contact-btn">
                                Contact
                            </a>
                            <button class="collaborate-btn" data-provider="<?= htmlspecialchars($hotel['HotelName']) ?>">
                                Collaborate
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No other hotels available for partnerships.</p>
        <?php endif; ?>
    </div>
    
    <!-- Table View (Hidden by default) -->
    <table id="hotels-table-view" style="display:none;">
        <thead>
            <tr>
                <th>Hotel Name</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($hotels)): ?>
                <?php foreach($hotels as $hotel): ?>
                    <tr>
                        <td><?= htmlspecialchars($hotel['HotelName']) ?></td>
                        <td><?= htmlspecialchars($hotel['Address']) ?></td>
                        <td><?= htmlspecialchars($hotel['Phone']) ?></td>
                        <td class="action-buttons">
                            <a href="mailto:<?= htmlspecialchars($hotel['Email']) ?>" class="contact-btn">
                                Contact
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No other hotels available for partnerships.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Restaurants Section -->
    <h2 class="section-header">Restaurants</h2>
    
    <!-- Card View (Default) -->
    <div class="provider-grid" id="restaurants-card-view">
        <?php if (!empty($restaurants)): ?>
            <?php foreach($restaurants as $restaurant): ?>
                <div class="provider-card">
                    <div class="card-header restaurant"><?= htmlspecialchars($restaurant['Name']) ?></div>
                    <div class="card-body">
                        <div class="provider-info">
                            <p><span class="label">Location:</span> <?= htmlspecialchars($restaurant['Address']) ?></p>
                            <p><span class="label">Phone:</span> <?= htmlspecialchars($restaurant['Phone']) ?></p>
                            <p><span class="label">Email:</span> <?= htmlspecialchars($restaurant['Email']) ?></p>
                        </div>
                        <div class="action-buttons">
                            <a href="mailto:<?= htmlspecialchars($restaurant['Email']) ?>" class="contact-btn">
                                Contact
                            </a>
                            <button class="collaborate-btn" data-provider="<?= htmlspecialchars($restaurant['Name']) ?>">
                                Collaborate
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No restaurants available for partnerships.</p>
        <?php endif; ?>
    </div>
    
    <!-- Table View (Hidden by default) -->
    <table id="restaurants-table-view" style="display:none;">
        <thead>
            <tr>
                <th>Restaurant Name</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($restaurants)): ?>
                <?php foreach($restaurants as $restaurant): ?>
                    <tr>
                        <td><?= htmlspecialchars($restaurant['Name']) ?></td>
                        <td><?= htmlspecialchars($restaurant['Address']) ?></td>
                        <td><?= htmlspecialchars($restaurant['Phone']) ?></td>
                        <td class="action-buttons">
                            <a href="mailto:<?= htmlspecialchars($restaurant['Email']) ?>" class="contact-btn">
                                Contact
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No restaurants available for partnerships.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Cultural Events Section -->
    <h2 class="section-header">Cultural Events</h2>
    
    <!-- Card View (Default) -->
    <div class="provider-grid" id="cultural-events-card-view">
        <?php if (!empty($culturalEvents)): ?>
            <?php foreach($culturalEvents as $event): ?>
                <div class="provider-card">
                    <div class="card-header cultural"><?= htmlspecialchars($event['Name']) ?></div>
                    <div class="card-body">
                        <div class="provider-info">
                            <p><span class="label">Location:</span> <?= htmlspecialchars($event['Address']) ?></p>
                            <p><span class="label">Phone:</span> <?= htmlspecialchars($event['Phone']) ?></p>
                            <p><span class="label">Email:</span> <?= htmlspecialchars($event['Email']) ?></p>
                        </div>
                        <div class="action-buttons">
                            <a href="mailto:<?= htmlspecialchars($event['Email']) ?>" class="contact-btn">
                                Contact
                            </a>
                            <button class="collaborate-btn" data-provider="<?= htmlspecialchars($event['Name']) ?>">
                                Collaborate
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No cultural events available for partnerships.</p>
        <?php endif; ?>
    </div>
    
    <!-- Table View (Hidden by default) -->
    <table id="cultural-events-table-view" style="display:none;">
        <thead>
            <tr>
                <th>Event Name</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($culturalEvents)): ?>
                <?php foreach($culturalEvents as $event): ?>
                    <tr>
                        <td><?= htmlspecialchars($event['Name']) ?></td>
                        <td><?= htmlspecialchars($event['Address']) ?></td>
                        <td><?= htmlspecialchars($event['Phone']) ?></td>
                        <td class="action-buttons">
                            <a href="mailto:<?= htmlspecialchars($event['Email']) ?>" class="contact-btn">
                                Contact
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No cultural events available for partnerships.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Heritage Markets Section -->
    <h2 class="section-header">Heritage Markets</h2>
    
    <!-- Card View (Default) -->
    <div class="provider-grid" id="markets-card-view">
        <?php if (!empty($heritageMarkets)): ?>
            <?php foreach($heritageMarkets as $market): ?>
                <div class="provider-card">
                    <div class="card-header market"><?= htmlspecialchars($market['Name']) ?></div>
                    <div class="card-body">
                        <div class="provider-info">
                            <p><span class="label">Location:</span> <?= htmlspecialchars($market['Address']) ?></p>
                            <p><span class="label">Phone:</span> <?= htmlspecialchars($market['Phone']) ?></p>
                            <p><span class="label">Email:</span> <?= htmlspecialchars($market['Email']) ?></p>
                        </div>
                        <div class="action-buttons">
                            <a href="mailto:<?= htmlspecialchars($market['Email']) ?>" class="contact-btn">
                                Contact
                            </a>
                            <button class="collaborate-btn" data-provider="<?= htmlspecialchars($market['Name']) ?>">
                                Collaborate
                            </button>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>No heritage markets available for partnerships.</p>
        <?php endif; ?>
    </div>
    
    <!-- Table View (Hidden by default) -->
    <table id="markets-table-view" style="display:none;">
        <thead>
            <tr>
                <th>Market Name</th>
                <th>Location</th>
                <th>Contact</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($heritageMarkets)): ?>
                <?php foreach($heritageMarkets as $market): ?>
                    <tr>
                        <td><?= htmlspecialchars($market['Name']) ?></td>
                        <td><?= htmlspecialchars($market['Address']) ?></td>
                        <td><?= htmlspecialchars($market['Phone']) ?></td>
                        <td class="action-buttons">
                            <a href="mailto:<?= htmlspecialchars($market['Email']) ?>" class="contact-btn">
                                Contact
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="4" class="text-center">No heritage markets available for partnerships.</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <!-- Add JavaScript for toggling between card and table views -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const cardViewBtn = document.getElementById('card-view-btn');
            const tableViewBtn = document.getElementById('table-view-btn');
            
            const cardViews = document.querySelectorAll('[id$="-card-view"]');
            const tableViews = document.querySelectorAll('[id$="-table-view"]');
            
            cardViewBtn.addEventListener('click', function() {
                cardViewBtn.classList.add('active');
                tableViewBtn.classList.remove('active');
                
                cardViews.forEach(view => view.style.display = 'flex');
                tableViews.forEach(view => view.style.display = 'none');
            });
            
            tableViewBtn.addEventListener('click', function() {
                tableViewBtn.classList.add('active');
                cardViewBtn.classList.remove('active');
                
                cardViews.forEach(view => view.style.display = 'none');
                tableViews.forEach(view => view.style.display = 'table');
            });
            
            // Handle collaborate button clicks
            const collaborateButtons = document.querySelectorAll('.collaborate-btn');
            collaborateButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const providerName = this.getAttribute('data-provider');
                    alert(`Collaboration request sent to ${providerName}. They will contact you shortly.`);
                });
            });
        });
    </script>
</div>
</body>
</html>
