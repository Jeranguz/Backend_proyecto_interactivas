 

const swiper = new Swiper(".swiper-hero", {
   
    slidesPerView: 1,
    spaceBetween: 55,
    loopAdditionalSlides:5,
    parallax: true,
    
    loop: true,

    autoplay: {
      delay: 1500,

      pauseOnMouseEnter: true,
      disableOnInteraction: false,
    },

    navigation: {
      nextEl: ".swiper-button-next",
      prevEl: ".swiper-button-prev",
    },

    
    pagination: {
      el: ".swiper-pagination",
      clickable: true,
    },

    breakpoints:{

      680: {
        slidesPerView: 1,
        spaceBetween:20, 
    },

      950: {
        slidesPerView: 2,
        spaceBetween:20, 

      },

    1600: {
      slidesPerView: 3,
        spaceBetween:20, 
    },

    },

  });


  