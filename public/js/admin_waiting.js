const images = [
    '../public/images/background_slideshow/a.avif',
    '../public/images/background_slideshow/b.jpg',
    '../public/images/background_slideshow/c.jpg',
    '../public/images/background_slideshow/e.avif',
    '../public/images/background_slideshow/f.avif',
    '../public/images/background_slideshow/g.jpeg',
    '../public/images/background_slideshow/i.jpg',
    '../public/images/background_slideshow/k.webp'
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