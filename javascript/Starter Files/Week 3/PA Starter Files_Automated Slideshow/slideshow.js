// Automated Slideshow JavaScript
// This script uses setInterval() to cycle through ISS images with captions

// Array of image file paths
const images = [
    "slide0.jpg",
    "slide1.jpg",
    "slide2.jpg",
    "slide3.jpg",
    "slide4.jpg",
    "slide5.jpg",
    "slide6.jpg",
    "slide7.jpg",
    "slide8.jpg",
    "slide9.jpg",
    "slide10.jpg",
    "slide11.jpg",
    "slide12.jpg",
    "slide13.jpg"
];

// Parallel array of captions matching each image
const captions = [
    "International Space Station fourth expansion [2009]",
    "Assembling the International Space Station [1998]",
    "The Atlantis docks with the ISS [2001]",
    "The Atlantis approaches the ISS [2000]",
    "The Soyuz departs from the ISS [2001]",
    "International Space Station over Earth [2002]",
    "The International Space Station first expansion [2002]",
    "Hurricane Ivan from the ISS [2008]",
    "The Soyuz spacecraft approaches the ISS [2005]",
    "The International Space Station from above [2006]",
    "Maneuvering in space with the Canadarm2 [2006]",
    "The International Space Station second expansion [2006]",
    "The International Space Station third expansion [2007]",
    "The ISS over the Ionian Sea [2007]"
];

// Track current slide index
let currentIndex = 0;

// Get DOM elements
const slideshowImg = document.getElementById("slideshow-img");
const captionText = document.getElementById("caption");

// Function to update the slideshow
function updateSlide() {
    // Update image source and caption text
    slideshowImg.src = images[currentIndex];
    captionText.textContent = captions[currentIndex];

    // Increment index with wrap-around (start over when end is reached)
    currentIndex = (currentIndex + 1) % images.length;
}

// Display the first slide immediately
updateSlide();

// Use setInterval to cycle through slides every 3 seconds (3000 milliseconds)
setInterval(updateSlide, 3000);
