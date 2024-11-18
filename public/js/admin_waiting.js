const images = [
    '../public/images/a.avif',
    '../public/images/b.jpg',
    '../public/images/c.jpg',
    '../public/images/e.avif',
    '../public/images/f.avif',
    '../public/images/g.jpeg',
    '../public/images/i.jpg',
    '../public/images/k.webp'
];

let index = 0;

// Function to change background image
function changeBackgroundImage() {
    index = Math.floor(Math.random() * images.length);
    document.body.style.backgroundImage = `url('${images[index]}')`;
}

// Change background image every 5 seconds
setInterval(changeBackgroundImage, 5000);

// Initial background set
changeBackgroundImage();