let selectedYear = null;
let selectedType = null;

// Function to load default content (About for the first year and action)
function loadDefaultContent() {
    // Select the first year button and set it as selected
    const firstYearButton = document.querySelector('.year-button');
    if (firstYearButton) {
        firstYearButton.classList.add('selected');
        selectedYear = firstYearButton.getAttribute('data-year');

        // Enable the action buttons
        document.getElementById('about-button').disabled = false;
        document.getElementById('images-button').disabled = false;
        document.getElementById('videos-button').disabled = false;

        // Select the first action button (About) and fetch its content
        document.getElementById('about-button').classList.add('selected');
        selectedType = 'about';
        fetchContent('about');
    }
}

// Handle year button selection
document.querySelectorAll('.year-button').forEach((button) => {
    button.addEventListener('click', function () {
        document.querySelectorAll('.year-button').forEach((btn) => btn.classList.remove('selected'));
        this.classList.add('selected');
        selectedYear = this.getAttribute('data-year');

        // Enable action buttons only if a year is selected
        if (selectedYear && selectedType) {
            document.getElementById('about-button').disabled = false;
            document.getElementById('images-button').disabled = false;
            document.getElementById('videos-button').disabled = false;
        }

        // Fetch content for the selected year (default to "about")
        fetchContent('about');
    });
});

// Handle action button clicks
document.getElementById('about-button').addEventListener('click', () => {
    selectedType = 'about';
    fetchContent('about');
});
document.getElementById('images-button').addEventListener('click', () => {
    selectedType = 'images';
    fetchContent('images');
});
document.getElementById('videos-button').addEventListener('click', () => {
    selectedType = 'videos';
    fetchContent('videos');
});

// Function to fetch and display content
function fetchContent(type) {
    const contentContainer = document.getElementById('content-container');

    if (!selectedYear || !selectedType) {
        contentContainer.innerHTML = '<p style="color: red;">Please select both a year and an action.</p>';
        return;
    }

    fetch('fetch_content.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `year=${encodeURIComponent(selectedYear)}&type=${encodeURIComponent(type)}`,
    })
    .then((response) => response.json())
    .then((data) => {
        if (data.success) {
            if (type === 'about') {
                contentContainer.innerHTML = `<p>${data.content}</p>`;
            } else if (type === 'images') {
                contentContainer.innerHTML = data.content
                    .map((img) => `<img src="images/${img}" alt="${img}">`)
                    .join('');
            } else if (type === 'videos') {
                contentContainer.innerHTML = data.content
                    .map((video) => `<video controls src="videos/${video}"></video>`)
                    .join('');
            }
        } else {
            contentContainer.innerHTML = `<p style="color: red;">${data.message}</p>`;
        }
    })
    .catch((error) => {
        contentContainer.innerHTML = `<p style="color: red;">An error occurred while fetching content.</p>`;
        console.error('Error:', error);
    });
}

// Load default content on page load
window.onload = loadDefaultContent;