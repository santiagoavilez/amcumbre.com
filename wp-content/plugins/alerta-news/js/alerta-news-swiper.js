document.addEventListener("DOMContentLoaded", function () {
  if (window.innerWidth > 768) {
    // Swiper para computadoras (8 noticias, mostrando 4 a la vez)
    var desktopSwiper = new Swiper(".desktop-swiper", {
      slidesPerView: 4,
      spaceBetween: 10,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  } else {
    // Primer Swiper en móviles (primer grupo de 4 noticias)
    var mobileSwiper1 = new Swiper(".mobile-swiper-1", {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });

    // Segundo Swiper en móviles (segundo grupo de 4 noticias)
    var mobileSwiper2 = new Swiper(".mobile-swiper-2", {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next",
        prevEl: ".swiper-button-prev",
      },
    });
  }
});
