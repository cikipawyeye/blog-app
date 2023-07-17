const message = "Author: M Zufar Fainan | mzufarfainan@gmail.com | @kelasbahasaturki.id";
console.log(message);

// toggle btn navbar
const toggleButton = document.querySelector(".toggle input");

// navbar
const navbar = document.querySelector("nav");

// show navbar menu on mobile
toggleButton.addEventListener("click", () => {
  navbar.classList.toggle("slide")
})