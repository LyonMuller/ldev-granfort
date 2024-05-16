// @koala-prepend "plugins/splide.js"
document.addEventListener('DOMContentLoaded', function () {
  
  if (document.querySelector('.depoimentos-slider')) {
    const depoimentos = new Splide('.depoimentos-slider', {
      type: 'loop',
      arrows: true,
      autoplay: true,
      pagination: true,
      gap: '2rem',
      interval: 6000,
      perPage: 2,
      breakpoints: {
        768: {
          perPage: 1,
        }
      }
    });
    depoimentos.mount(window.splide.Extensions);
  }

});