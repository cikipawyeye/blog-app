const message = "Author: M Zufar Fainan | mzufarfainan@gmail.com | @kelasbahasaturki.id";
console.log(message);


// toggle btn navbar
const toggleButton = document.querySelector(".toggle input");

// show navbar menu on mobile
toggleButton.addEventListener("click", () => {
  navbar.classList.toggle("slide")
});

// navbar
const navbar = document.querySelector("nav");
const navLogo = document.querySelector(".nav-logo");

// change color navbar on scroll
window.addEventListener("scroll", () => {
  if (this.scrollY > 1) {
    navbar.classList.add("change-color")
    navLogo.classList.remove("scale-up")
    navbar.style.fontSize = '14px';
  } else {
    navbar.style.fontSize = '15px';
    navLogo.classList.add("scale-up")
    navbar.classList.remove("change-color")
  }
})


// swiper
var bannerSlider = new Swiper('.banner-slider', {
  effect: 'coverflow',
  grabCursor: true,
  centeredSlides: true,
  loop: false,
  spaceBetween: 10,
  slidesPerView: 'auto',
  coverflowEffect: {
    rotate: 0,
    stretch: 0,
    depth: 200,
    modifier: 3.5,
  },
  pagination: {
    el: '.banner-swiper-pagination',
    clickable: true,
  },
  navigation: {
    nextEl: '.banner-swiper-button-next',
    prevEl: '.banner-swiper-button-prev',
  }
});


if (window.innerWidth < 568) {
  var swiper = new Swiper(".slide-content", {
    effect: "creative",
    creativeEffect: {
      prev: {
        // will set `translateZ(-400px)` on previous slides
        translate: [-50, 50, -400],
        // rotate: [12],
      },
      next: {
        // will set `translateX(100%)` on next slides
        translate: ['108%', 0, 0],
      },
    },
    grabCursor: true,
  });
} else if (window.innerWidth < 900) {
  var swiper = new Swiper(".slide-content", {
    slidesPerView: 1,
    spaceBetween: 60,
    loop: false,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".card-swiper-button-next",
      prevEl: ".card-swiper-button-prev",
    },
  });
} else if (window.innerWidth < 1350) {
  var swiper = new Swiper(".slide-content", {
    slidesPerView: 2,
    spaceBetween: 60,
    loop: false,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".card-swiper-button-next",
      prevEl: ".card-swiper-button-prev",
    },
  });
} else {
  var swiper = new Swiper(".slide-content", {
    slidesPerView: 3,
    spaceBetween: 60,
    loop: false,
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },
    navigation: {
      nextEl: ".card-swiper-button-next",
      prevEl: ".card-swiper-button-prev",
    },
  });
}

// timeline kuliah di turki
$(".step").click(function () {
  $(this).addClass("active").prevAll().addClass("active");
  $(this).nextAll().removeClass("active");
});

$(".step01").click(function () {
  $("#line-progress").css("width", "3%");
  $(".discovery").addClass("active").siblings().removeClass("active");
});

$(".step02").click(function () {
  $("#line-progress").css("width", "25%");
  $(".strategy").addClass("active").siblings().removeClass("active");
});

$(".step03").click(function () {
  $("#line-progress").css("width", "50%");
  $(".creative").addClass("active").siblings().removeClass("active");
});

$(".step04").click(function () {
  $("#line-progress").css("width", "75%");
  $(".production").addClass("active").siblings().removeClass("active");
});

$(".step05").click(function () {
  $("#line-progress").css("width", "100%");
  $(".analysis").addClass("active").siblings().removeClass("active");
});

// nilai faq
// const question = document.querySelectorAll(".standar-nilai .faq-container .faq");
// const answer = document.querySelectorAll(".answer");

// question.forEach(function (value) {
//   value.addEventListener('click', () => {
//     if (value.querySelector(".answer").classList.contains("hide-answer")) {
//       value.querySelector(".answer").classList.remove("hide-answer")
//     } else {
//       value.querySelector(".answer").classList.add("hide-answer")
//     }
//   })
// })

