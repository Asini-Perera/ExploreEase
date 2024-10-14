const images = [
    'public/images/a.avif',
    'public/images/b.jpg',
    'public/images/c.jpg'
];

let index = 0;

// Function to change background image
function changeBackgroundImage() {
    document.body.style.backgroundImage = `url('${images[index]}')`;
    index = (index + 1) % images.length;
}

// Change background image every 5 seconds
setInterval(changeBackgroundImage, 5000);

// Initial background set
changeBackgroundImage();
