document.addEventListener('DOMContentLoaded', function () {

  if (window.innerWidth > 768) {
    // Swiper para computadoras (8 noticias, mostrando 4 a la vez)
    const desktopSwiper = new Swiper(".desktop-swiper", {
      slidesPerView: 4,
      spaceBetween: 8,
      loop: true,

      navigation: {
        nextEl: "#swiper-button-next",
        prevEl: "#swiper-button-prev",
      },
      autoplay: {
        delay: 2000,
      },
    });

  } else {
    // Primer Swiper en móviles (primer grupo de 4 noticias)
    const mobileSwiper1 = new Swiper(".mobile-swiper-1", {
      slidesPerView: 1,
      spaceBetween: 12,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      autoplay: {
        delay: 2000,
      },
    });
    // Segundo Swiper en móviles (segundo grupo de 4 noticias)
    const mobileSwiper2 = new Swiper(".mobile-swiper-2", {
      slidesPerView: 1,
      spaceBetween: 12,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      autoplay: {
        delay: 2000,
      },
    });
  }

});
