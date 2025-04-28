const servicesData = [
  { image: "../public/images/hilton.jpg", city: "Colombo", category: "hotel", name: "Hilton Hotel", description: "A luxurious beachside hotel.", price: "Above LKR 5000.00", rate: "4" },
  { image: "../public/images/book_table.jpg", city: "Colombo", category: "restaurant", name: "Golden Fork", description: "Fine dining experience.", price: "Above LKR 3000.00", rate: "5" },
  { image: "../public/images/laksala.jpg", city: "Colombo", category: "heritage_market", name: "Laksala", description: "Local crafts hub.", price: "Products above LKR 1000.00", rate: "4" },
  { image: "../public/images/wes.jpg", city: "Colombo", category: "cultural_event", name: "Folk Music Festival", description: "Local music celebration.", price: "Tickets above LKR 2000.00", rate: "5" },
  // Add more services for different cities
];

function filterServices(selectedCategory) {
  const selectedCity = document.getElementById('city-select').value;
  const resultsDiv = document.getElementById('results');

  resultsDiv.innerHTML = ''; // Clear previous results

  if (!selectedCity) {
    resultsDiv.innerHTML = '<p class="error-msg">Please select a city.</p>';
    return;
  }

  const filtered = servicesData.filter(service => 
    service.city === selectedCity && service.category === selectedCategory
  );

  if (filtered.length > 0) {
    filtered.forEach(service => {
      const card = `
        <div class="service-card">
          <img src="${service.image}" alt="${service.name}">
          <h3>${service.name}</h3>
          <p>${service.description}</p>
          <p><strong>Price:</strong> ${service.price}</p>
          <p><strong>Rating:</strong> ${service.rate}/5</p>
          <button onclick="navigateToPage('${service.category}', '${service.name}')">View Details</button>
        </div>
      `;
      resultsDiv.innerHTML += card;
    });
  } else {
    resultsDiv.innerHTML = '<p class="error-msg">No services found.</p>';
  }
}

function navigateToPage(category, name) {
  const baseUrls = {
    hotel: 'http://localhost/ExploreEase/service/hotel',
    restaurant: 'http://localhost/ExploreEase/service/restaurant',
    heritage_market: 'http://localhost/ExploreEase/heritagemarket/products',
    cultural_event: 'http://localhost/ExploreEase/service/cultural_event'
  };

  const encodedName = encodeURIComponent(name);
  const url = `${baseUrls[category]}?name=${encodedName}`;
  window.location.href = url;
}
