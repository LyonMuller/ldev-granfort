// @koala-prepend "plugins/splide.js"
document.addEventListener('DOMContentLoaded', function () {

  if (document.querySelector('.imagens-banner')) {
    const banner = new Splide('.imagens-banner', {
      type: 'loop',
      arrows: false,
      autoplay: true,
      pagination: true,
      gap: '0',
      interval: 3000,
      lazyLoad: 'nearby',
    });
    banner.mount(window.splide.Extensions);
  }
});