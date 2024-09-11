document.addEventListener('DOMContentLoaded', function () {
  console.log("swiper.js cargado");
  
  if (window.innerWidth > 768) {
    // Swiper para computadoras (8 noticias, mostrando 4 a la vez)
    const desktopSwiper = new Swiper(".desktop-swiper", {
      slidesPerView: 4,
      spaceBetween: 10,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next-pc",
        prevEl: ".swiper-button-prev-pc",
      },
      autoplay: {
        delay: 2000,
      },
    });
    desktopSwiper.slideNext();
    console.log("Desktop slider", desktopSwiper);

  } else {
    // Primer Swiper en móviles (primer grupo de 4 noticias)
    const mobileSwiper1 = new Swiper(".mobile-swiper-1", {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next-1",
        prevEl: ".swiper-button-prev-1",
      },
      autoplay: {
        delay: 2000,
      },
    });
    // Segundo Swiper en móviles (segundo grupo de 4 noticias)
    const mobileSwiper2 = new Swiper(".mobile-swiper-2", {
      slidesPerView: 1,
      spaceBetween: 10,
      loop: true,
      pagination: {
        el: ".swiper-pagination",
        clickable: true,
      },
      navigation: {
        nextEl: ".swiper-button-next-2",
        prevEl: ".swiper-button-prev-2",
      },
      autoplay: {
        delay: 2000,
      },
    });
  }

});
