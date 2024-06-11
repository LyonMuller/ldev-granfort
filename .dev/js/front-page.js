// @koala-prepend "plugins/splide.js"
document.addEventListener('DOMContentLoaded', function () {

  if (document.querySelector('.secao-banner__home .splide')) {
    const banner = new Splide('.secao-banner__home .splide', {
      type: 'loop',
      arrows: true,
      autoplay: true,
      pagination: true,
      gap: '0',
      interval: 12000,
      lazyLoad: 'nearby',
    });
    banner.mount(window.splide.Extensions);

    const toggleButton = document.createElement('button');
    const pauseSVG = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path fill="currentColor" d="M128 64H0V448H128V64zm192 0H192V448H320V64z"/></svg>';
    const playSVG = '<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path fill="currentColor" d="M384 256L0 32V480L384 256z"/></svg>';
    toggleButton.innerHTML = pauseSVG;
    toggleButton.classList.add('btn-video');

    toggleButton.setAttribute('aria-label', 'Pause');

    document.querySelector('.secao-banner__home').appendChild(toggleButton);

    let isPaused = false;

    const updateButtonState = () => {
      if (isPaused) {
        toggleButton.setAttribute('aria-label', 'Play');
        toggleButton.innerHTML = playSVG;
      } else {
        toggleButton.setAttribute('aria-label', 'Pause');
        toggleButton.innerHTML = pauseSVG;
      }
    };

    toggleButton.addEventListener('click', function() {
      const allSlides = banner.Components.Elements.slides;
      if (isPaused) {
        // Resume autoplay and videos
        banner.options = { ...banner.options, autoplay: true };
        const currentSlide = banner.Components.Elements.slides[banner.index];
        const video = currentSlide.querySelector('video');
        if (video) {
          video.play().catch(error => {
            console.log('Error playing video:', error);
          });
        }
      } else {
        // Pause autoplay and videos
        banner.options = { ...banner.options, autoplay: false };
        allSlides.forEach(function (slide) {
          const video = slide.querySelector('video');
          if (video) {
            video.pause();
          }
        });
      }
      isPaused = !isPaused;
      updateButtonState();
    });

    banner.on('move', function(index) {
      const slide = banner.Components.Elements.slides[index];
      const allSlides = banner.Components.Elements.slides;
      allSlides.forEach(function (slide) {
        const video = slide.querySelector('video');
        if (video) {
          video.pause();
        }
      });
      const video = slide.querySelector('video');
      if (video) {
        video.play().catch(error => {
          console.log('Error playing video:', error);
        });
      }
      // Update button state to indicate autoplay is running
      isPaused = false;
      updateButtonState();
    });

    const observer = new IntersectionObserver(function(entries) {
      entries.forEach(function(entry) {
        if (entry.isIntersecting) {
          // Element is visible
          if (!isPaused) {
            const video = entry.target.querySelector('video');
            if (video && video.paused) {
              video.play().catch(error => {
                console.log('Error playing video:', error);
              });
            }
            banner.options = { ...banner.options, autoplay: true };
          }
        } else {
          // Element is not visible
          const allSlides = banner.Components.Elements.slides;
          allSlides.forEach(function (slide) {
            const video = slide.querySelector('video');
            if (video) {
              video.pause();
            }
          });
          banner.options = { ...banner.options, autoplay: false };
        }
      });
    });
    observer.observe(document.querySelector('.secao-banner__home .splide'));
  }

  const itemsPerPage = 4;
  const buttons = document.querySelectorAll('.filters button');
  const boatItems = Array.from(document.querySelectorAll('.boat-item-cont'));
  const prevPageButton = document.getElementById('prev-page');
  const nextPageButton = document.getElementById('next-page');
  const pageIndicator = document.getElementById('page-indicator');
  const activeClass = 'active';
  let currentPage = 1;
  let filteredItems = [...boatItems];

  const renderItems = () => {
    boatItems.forEach(item => item.style.display = 'none');
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    filteredItems.slice(startIndex, endIndex).forEach(item => item.style.display = 'block');
    const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
    pageIndicator.innerHTML = `<span class="t-secondary">${currentPage}</span> / ${totalPages}`;

    // Adicionar classe active aos itens visíveis
    boatItems.forEach(item => item.classList.remove(activeClass));
    filteredItems.slice(startIndex, endIndex).forEach(item => item.classList.add(activeClass));

    // Atualizar visibilidade dos botões de paginação
    // prevPageButton.classList.toggle = currentPage > 1 ? '' : 'disabled';
    // nextPageButton.classList.toggle = currentPage < totalPages ? '' : 'disabled';
    // change attr disabled to next/prev buttons
    prevPageButton.disabled = currentPage === 1;
    nextPageButton.disabled = currentPage === totalPages;
  };

  const filterItems = (filter) => {
    filteredItems = filter === 'all' ? [...boatItems] : boatItems.filter(item => item.classList.contains(filter));
    currentPage = 1;
    renderItems();

    // Adicionar classe active ao botão filtrado
    buttons.forEach(button => button.classList.remove(activeClass));
    document.querySelector(`button[data-filter="${filter}"]`).classList.add(activeClass);
  };

  buttons.forEach(button => {
    button.addEventListener('click', () => filterItems(button.getAttribute('data-filter')));
  });

  prevPageButton.addEventListener('click', () => {
    if (currentPage > 1) {
      currentPage--;
      renderItems();
    }
  });

  nextPageButton.addEventListener('click', () => {
    const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
    if (currentPage < totalPages) {
      currentPage++;
      renderItems();
    }
  });

  renderItems(); // Initial render
});