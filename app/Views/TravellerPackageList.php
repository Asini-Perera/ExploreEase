<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Explore Packages</title>
  <link rel="stylesheet" href="/ExploreEase/public/css/TravellerPackageList.css?v=2">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
</head>

<body>

  <?php require_once __DIR__ . '/loggedNavbar.php'; ?>

  <section class="packages-section">
    <h1>Available Travel Packages</h1>
    <div class="packages-list">


      <div class="package-card">
        <img src="/ExploreEase/public/images/sigiriya.jpg" alt="Sigiriya Adventure" class="package-image">
        <div class="package-details">
          <h2>Sigiriya & Cultural Triangle Tour</h2>
          <p class="package-desc">3-day exploration of Sri Lanka’s ancient kingdoms and heritage sites.</p>
          <ul class="services-included">
            <li>🏨 Cinnamon Lodge</li>
            <li>🍽️ Tropical Village Dining</li>
            <li>🎭 Kandy Cultural Show</li>
            <li>🛍️ Dambulla Heritage Market</li>
          </ul>
          <div class="price-location">
            <span class="price">Active</span>
            <span class="location">Sigiriya, Dambulla</span>
          </div>
          <div class="discount-status">
            <div class="discount">💸 15% Off on your bills</div>
          </div>
          <div class="date-range"><strong>Valid:</strong> May 1 - Sep 30, 2025</div>
          <div class="terms"><small>* 7-day free cancellation</small></div>
          <a href="#" class="btn-register">Register for Package</a>
          <div class="reviews">★★★★☆ (45 Reviews)</div>
        </div>
      </div>

      <!-- <div class="package-card">
    <img src="/ExploreEase/public/images/ella.jpg" alt="Ella Adventure" class="package-image">
    <div class="package-details">
      <h2>Ella Nature & Adventure Escape</h2>
      <p class="package-desc">2 nights in Ella's green hills with waterfall visits and hikes.</p>
      <ul class="services-included">
        <li>🏨 Ella Flower Garden Resort</li>
        <li>🍽️ Cafe Chill Ella</li>
        <li>🎭 Ella Music Festival</li>
        <li>🛍️ Local Handicraft Market</li>
      </ul>
      <div class="price-location">
        <span class="price">Upcoming</span>
        <span class="location">Ella</span>
      </div>
      <div class="discount-status">
        <div class="discount">💸 20% Off on your bills</div>
      </div>
      <div class="date-range"><strong>Valid:</strong> Jun 1 - Oct 31, 2025</div>
      <div class="terms"><small>* 5-day free cancellation</small></div>
      <a href="#" class="btn-register">Register for Package</a>
      <div class="reviews">★★★★★ (62 Reviews)</div>
    </div>
  </div>

  <div class="package-card">
    <img src="/ExploreEase/public/images/galle.jpg" alt="Galle Tour" class="package-image">
    <div class="package-details">
      <h2>Galle Dutch Heritage & Beach</h2>
      <p class="package-desc">Historic walks and sunny beaches packed into a relaxing weekend.</p>
      <ul class="services-included">
        <li>🏨 Jetwing Lighthouse Hotel</li>
        <li>🍽️ Tuna & The Crab Restaurant</li>
        <li>🎭 Galle Fort Art Fair</li>
        <li>🛍️ Galle Fort Bazaar</li>
      </ul>
      <div class="price-location">
        <span class="price">Active</span>
        <span class="location">Galle</span>
      </div>
      <div class="discount-status">
        <div class="discount">💸 10% Off on your bills</div>
      </div>
      <div class="date-range"><strong>Valid:</strong> May 15 - Dec 15, 2025</div>
      <div class="terms"><small>* Full refund before 10 days</small></div>
      <a href="#" class="btn-register">Register for Package</a>
      <div class="reviews">★★★★☆ (39 Reviews)</div>
    </div>
  </div>

  <div class="package-card">
    <img src="/ExploreEase/public/images/nuwaraeliya.jpg" alt="Nuwara Eliya" class="package-image">
    <div class="package-details">
      <h2>Nuwara Eliya Tea Trails Tour</h2>
      <p class="package-desc">Escape to the "Little England" with tea gardens and cool breezes.</p>
      <ul class="services-included">
        <li>🏨 Grand Hotel Nuwara Eliya</li>
        <li>🍽️ Hill Club Dining</li>
        <li>🎭 Tea Factory Tour</li>
        <li>🛍️ Local Fresh Market Visit</li>
      </ul>
      <div class="price-location">
        <span class="price">Upcoming</span>
        <span class="location">Nuwara Eliya</span>
      </div>
      <div class="discount-status">
        <div class="discount">💸 15% Off on your bills</div>
      </div>
      <div class="date-range"><strong>Valid:</strong> May 1 - Aug 31, 2025</div>
      <div class="terms"><small>* Cancellation within 5 days</small></div>
      <a href="#" class="btn-register">Register for Package</a>
      <div class="reviews">★★★★★ (48 Reviews)</div>
    </div>
  </div>

  <div class="package-card">
    <img src="/ExploreEase/public/images/yala.jpg" alt="Yala Safari" class="package-image">
    <div class="package-details">
      <h2>Yala National Park Safari</h2>
      <p class="package-desc">Wildlife adventure through the best safari trails in Sri Lanka.</p>
      <ul class="services-included">
        <li>🏨 Cinnamon Wild Yala</li>
        <li>🍽️ Safari Campfire Dining</li>
        <li>🎭 Wildlife Documentary Nights</li>
        <li>🛍️ Eco Craft Store</li>
      </ul>
      <div class="price-location">
        <span class="price">Active</span>
        <span class="location">Yala</span>
      </div>
      <div class="discount-status">
        <div class="discount">💸 10% Off on your bills</div>
      </div>
      <div class="date-range"><strong>Valid:</strong> May 1 - Nov 30, 2025</div>
      <div class="terms"><small>* 10-day cancellation window</small></div>
      <a href="#" class="btn-register">Register for Package</a>
      <div class="reviews">★★★★★ (58 Reviews)</div>
    </div>
  </div>

  <div class="package-card">
    <img src="/ExploreEase/public/images/kandy.jpg" alt="Kandy City" class="package-image">
    <div class="package-details">
      <h2>Kandy Royal & Spiritual Journey</h2>
      <p class="package-desc">Temple visits, royal gardens, and traditional performances await.</p>
      <ul class="services-included">
        <li>🏨 Earl's Regency Hotel</li>
        <li>🍽️ The Empire Cafe</li>
        <li>🎭 Temple of the Tooth Ceremony</li>
        <li>🛍️ Kandy Handloom Market</li>
      </ul>
      <div class="price-location">
        <span class="price">Upcoming</span>
        <span class="location">Kandy</span>
      </div>
      <div class="discount-status">
        <div class="discount">💸 15% Off on your bills</div>
      </div>
      <div class="date-range"><strong>Valid:</strong> May 1 - Dec 31, 2025</div>
      <div class="terms"><small>* 7-day cancellation</small></div>
      <a href="#" class="btn-register">Register for Package</a>
      <div class="reviews">★★★★☆ (51 Reviews)</div>
    </div>
  </div>

  <div class="package-card">
    <img src="/ExploreEase/public/images/bentota.jpg" alt="Bentota Beach" class="package-image">
    <div class="package-details">
      <h2>Bentota Luxury Beach Holiday</h2>
      <p class="package-desc">Golden sands, spa retreats, and vibrant water sports.</p>
      <ul class="services-included">
        <li>🏨 Cinnamon Bentota Beach</li>
        <li>🍽️ Sunset Lounge Restaurant</li>
        <li>🎭 Bentota Night Market</li>
        <li>🛍️ Coastal Boutique Shopping</li>
      </ul>
      <div class="price-location">
        <span class="price">Active</span>
        <span class="location">Bentota</span>
      </div>
      <div class="discount-status">
        <div class="discount">💸 20% Off on your bills</div>
      </div>
      <div class="date-range"><strong>Valid:</strong> May 1 - Dec 31, 2025</div>
      <div class="terms"><small>* 10% early booking discount</small></div>
      <a href="#" class="btn-register">Register for Package</a>
      <div class="reviews">★★★★★ (60 Reviews)</div>
    </div>
  </div>

  <div class="package-card">
    <img src="/ExploreEase/public/images/trinco.jpg" alt="Trincomalee" class="package-image">
    <div class="package-details">
      <h2>Trincomalee Beach & Culture Tour</h2>
      <p class="package-desc">Explore stunning beaches and rich Tamil culture.</p>
      <ul class="services-included">
        <li>🏨 Trinco Blu by Cinnamon</li>
        <li>🍽️ The Crab Restaurant</li>
        <li>🎭 Koneswaram Temple Visit</li>
        <li>🛍️ Nilaveli Beach Market</li>
      </ul>
      <div class="price-location">
        <span class="price">Upcoming</span>
        <span class="location">Trincomalee</span>
      </div>
      <div class="discount-status">
        <div class="discount">💸 10% Off on your bills</div>
      </div>
      <div class="date-range"><strong>Valid:</strong> May 1 - Oct 31, 2025</div>
      <div class="terms"><small>* 7-day cancellation</small></div>
      <a href="#" class="btn-register">Register for Package</a>
      <div class="reviews">★★★★☆ (44 Reviews)</div>
    </div>
  </div>


  <div class="package-card">
    <img src="/ExploreEase/public/images/colombo.jpg" alt="Colombo City" class="package-image">
    <div class="package-details">
      <h2>Colombo City Urban Escape</h2>
      <p class="package-desc">Modern city vibes, rooftop dinners, and vibrant shopping districts.</p>
      <ul class="services-included">
        <li>🏨 Shangri-La Colombo</li>
        <li>🍽️ Ministry of Crab</li>
        <li>🎭 Colombo City Walk</li>
        <li>🛍️ ODEL & One Galle Face Mall</li>
      </ul>
      <div class="price-location">
        <span class="price">Active</span>
        <span class="location">Colombo</span>
      </div>
      <div class="discount-status">
        <div class="discount">💸 15% Off on your bills</div>
      </div>
      <div class="date-range"><strong>Valid:</strong> May 1 - Dec 31, 2025</div>
      <div class="terms"><small>* No refund after 7 days</small></div>
      <a href="#" class="btn-register">Register for Package</a>
      <div class="reviews">★★★★☆ (55 Reviews)</div>
    </div>
  </div> -->

    </div>



  </section>
  <?php require_once __DIR__ . '/logedFooter.php'; ?>

</body>

</html>