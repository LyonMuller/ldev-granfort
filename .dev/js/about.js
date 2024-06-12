// @koala-prepend "plugins/splide.js"
document.addEventListener('DOMContentLoaded', function () {
  
  if (document.querySelector('.splide')) {
    const history = new Splide('.splide', {
      type: 'loop',
      arrows: true,
      autoplay: true,
      pagination: false,
      gap: '1rem',
      interval: 6000,
      perPage: 1,
      breakpoints: {
        768: {
          perPage: 1,
        }
      }
    });
    history.mount(window.splide.Extensions);
  }

});