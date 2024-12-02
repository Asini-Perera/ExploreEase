 // Simulated data (you can replace this with your database or API calls)
 const servicesData = [
    {image:"../public/images/hilton.jpg", city: "Colombo", category: "hotel", name: "Hilton Hotel", description: "A luxurious beachside hotel. ", price:"above LKR. 5000.00", rate:"4" },
    {image:"../public/images/mario.jpg", city: "Colombo", category: "hotel", name: "Mario Beach Hotel", description: "A luxurious beachside hotel. ", price:"above LKR. 5000.00", rate:"4" },
    {image:"../public/images/hilton(1).jpg", city: "Colombo", category: "hotel", name: "Ocean View Hotel", description: "A luxurious beachside hotel. ", price:"above LKR. 5000.00", rate:"4" },
    {image:"../public/images/book_table.jpg", city: "Colombo", category: "restaurant", name: "Golden Fork", description: "A fine dining experience." , price:"above LKR. 5000.00", rate:"4" },
    {image:"../public/images/restaurant-image1.jpg", city: "Colombo", category: "restaurant", name: "Golden Fork", description: "A fine dining experience." , price:"above LKR. 5000.00", rate:"4" },
    {image:"../public/images/restaurant-home.jpg", city: "Colombo", category: "restaurant", name: "Golden Fork", description: "A fine dining experience." , price:"above LKR. 5000.00", rate:"4" },
    {image:"../public/images/laksala.jpg", city: "Colombo", category: "heritage_market", name: "Laksala", description: "A hub for local crafts." , price:"products cabove LKR. 1000.00", rate:"4" },
    {image:"../public/images/bathik.jpg", city: "Colombo", category: "heritage_market", name: "Central Market", description: "A hub for local crafts." , price:"products are above LKR. 1000.00", rate:"4" },
    {image:"../public/images/wes.jpg", city: "Colombo", category: "cultural_event", name: "Folk Music Festival", description: "A celebration of local music." , price:"above LKR. 5000.00", rate:"4" },
    {image:"../public/images/traditional-danse-2.jpg", city: "Colombo", category: "cultural_event", name: "Annual Shanthikarma Festival", description: "A celebration of local music." , price:"above LKR. 5000.00", rate:"4" },
];

function searchServices(category) {
    const city = document.getElementById('search-bar').value.trim();
    const resultsDiv = document.getElementById('results');

    resultsDiv.innerHTML = '';
    
    if (!city) {
        resultsDiv.innerHTML = "<p class='error-msg'>Please enter a city name.</p>";
        return;
    }

    // Filter the servicesData array for matching city and category
    const results = servicesData.filter(service => 
        service.city.toLowerCase() === city.toLowerCase() && service.category === category
    );

    if (results.length > 0) {
        // Display the results
        resultsDiv.innerHTML = results.map(service => `
            <div class="service">
                <div>
                    <img src=${service.image} alt="hotel">
                </div>

                <div class="service-info">
                    <div class="left-section">
                        <h3>${service.name}</h3>
                        <span class="address">${service.address}</span>
                        <p class="description">${service.description}</p>
                        <p class="price">${service.price}</p>
                    </div>

                    <div class="right-section">
                        <p class="rate">rate : ${service.rate}/5</p>
                         <button onclick="navigateToPage('${service.category}', '${service.name}')">See Availability ></button>
                        
                    </div>
                </div>
            </div>
        `).join('');
    } else {
        resultsDiv.innerHTML = '<p class="error-msg">No services found for the selected city and category.</p>';
    }
}

function navigateToPage(category, name) {
    // Create a URL structure based on the category and name
    const basePage = {
        hotel: 'http://localhost/ExploreEase/service/hotel',
        restaurant: 'http://localhost/ExploreEase/service/restaurant',
        heritage_market: 'http://localhost/ExploreEase/heritageMarket/products',
        cultural_event: 'http://localhost/ExploreEase/service/cultural_event'
    };

    // Redirect to the corresponding page
    const targetPage = basePage[category];
    if (targetPage) {
        // Optionally pass the service name as a query parameter
        const encodedName = encodeURIComponent(name);
        window.location.href = `${targetPage}?name=${encodedName}`;
    } else {
        alert("Page not available for this service.");
    }
}
