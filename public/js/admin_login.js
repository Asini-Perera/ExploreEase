const images = [
    'public/images/a.avif',
    'public/images/b.jpg',
    'public/images/c.jpg',
    'public/images/d.jpg',
    'public/images/e.avif',
    'public/images/f.avif',
    'public/images/g.jpeg',
    'public/images/h.webp',
    'public/images/i.jpg',
    'public/images/k.webp'
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
