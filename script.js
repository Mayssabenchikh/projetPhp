// Select elements
const slides = document.querySelectorAll(".carousel-slide");
const prevBtn = document.querySelector(".prev-btn");
const nextBtn = document.querySelector(".next-btn");

let currentSlide = 0;

// Function to show a specific slide
function showSlide(index) {
  // Hide all slides
  slides.forEach((slide, i) => {
    slide.classList.remove("active");
    if (i === index) {
      slide.classList.add("active");
    }
  });
}

// Function to go to the next slide
function nextSlide() {
  currentSlide = (currentSlide + 1) % slides.length; // Loop back to the first slide
  showSlide(currentSlide);
}

// Function to go to the previous slide
function prevSlide() {
  currentSlide = (currentSlide - 1 + slides.length) % slides.length; // Loop to the last slide
  showSlide(currentSlide);
}

// Event listeners for buttons
nextBtn.addEventListener("click", nextSlide);
prevBtn.addEventListener("click", prevSlide);

// Automatically display the first slide on load
showSlide(currentSlide);

for (item of listItems) {
  item.onclick = function (e) {
    span.innerText = e.target.innerText;
    if (e.target.innerText == "Everything") {
      input.placeholder = "Search Anything...";
    } else {
      input.placeholder = "Search in " + e.target.innerText + "...";
    }
  };
}
