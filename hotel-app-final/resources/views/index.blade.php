<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Slideshow Smooth</title>
<script src="https://cdn.tailwindcss.com"></script>
<style>
  .slide-container {
    overflow: hidden;
    position: relative;
  }
  .slides {
    display: flex;
    transition: transform 0.8s ease-in-out; /* mượt hơn */
  }
  .slides img {
    min-width: 100%;
    object-fit: cover;
  }
</style>
</head>
<body class="bg-gray-100 flex items-center justify-center min-h-screen">

<div class="w-full max-w-5xl slide-container">
  <div id="slides" class="slides">
    <img src="https://booking.muongthanh.com/images/hotels/2023/07/07/resize/muong-thanh-luxury-ha-long-centre_1688699601.jpg" alt="Image 1">
    <img src="https://booking.muongthanh.com/images/hotels/2023/07/07/resize/muong-thanh-luxury-ha-long-centre-6_1688699601.jpg" alt="Image 2">
    <img src="https://booking.muongthanh.com/images/hotels/2023/07/07/resize/muong-thanh-luxury-ha-long-centre-2_1688699601.jpg" alt="Image 3">
    <img src="https://booking.muongthanh.com/images/hotels/2023/07/07/resize/muong-thanh-luxury-ha-long-centre-4_1688699600.jpg" alt="Image 4">
  </div>

  <!-- Prev/Next -->
  <button id="prev" class="absolute top-1/2 left-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white px-3 py-2 rounded hover:bg-opacity-70">❮</button>
  <button id="next" class="absolute top-1/2 right-4 transform -translate-y-1/2 bg-black bg-opacity-50 text-white px-3 py-2 rounded hover:bg-opacity-70">❯</button>

  <!-- Caption -->
  <div id="caption" class="absolute bottom-4 left-1/2 transform -translate-x-1/2 bg-black bg-opacity-50 text-white px-3 py-1 rounded text-lg">Image 1</div>
</div>

<script>
const images = [
  { src: "https://booking.muongthanh.com/images/hotels/2023/07/07/resize/muong-thanh-luxury-ha-long-centre_1688699601.jpg", caption: "Image 1" },
  { src: "https://booking.muongthanh.com/images/hotels/2023/07/07/resize/muong-thanh-luxury-ha-long-centre-6_1688699601.jpg", caption: "Image 2" },
  { src: "https://booking.muongthanh.com/images/hotels/2023/07/07/resize/muong-thanh-luxury-ha-long-centre-2_1688699601.jpg", caption: "Image 3" },
  { src: "https://booking.muongthanh.com/images/hotels/2023/07/07/resize/muong-thanh-luxury-ha-long-centre-4_1688699600.jpg", caption: "Image 4" },
];

let currentIndex = 0;
const slides = document.getElementById('slides');
const caption = document.getElementById('caption');
let timer;

function updateSlide() {
  slides.style.transform = `translateX(-${currentIndex * 100}%)`;
  caption.textContent = images[currentIndex].caption;
}

function nextSlide() {
  currentIndex = (currentIndex + 1) % images.length;
  updateSlide();
}

function prevSlide() {
  currentIndex = (currentIndex - 1 + images.length) % images.length;
  updateSlide();
}

function startTimer() {
  timer = setInterval(nextSlide, 3000);
}

function resetTimer() {
  clearInterval(timer);
  startTimer();
}

document.getElementById('next').addEventListener('click', () => { nextSlide(); resetTimer(); });
document.getElementById('prev').addEventListener('click', () => { prevSlide(); resetTimer(); });

// Initialize
updateSlide();
startTimer();
</script>

</body>
</html>
