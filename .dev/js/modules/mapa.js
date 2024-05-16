document.addEventListener('DOMContentLoaded', function () {
  // Seletores e variáveis iniciais
  const countrySelectMouseElements = document.querySelectorAll(".country-select-mouse[data-pais]");
  const countryElements = document.querySelectorAll(".country");
  const countryPathElements = document.querySelectorAll("path.country");
  const map = document.querySelector('.map > svg');
  const activeClass = "active";

  // Função para adicionar a classe 'active' ao país
  function addActiveClassCountry(pais) {
    const activeCountry = document.querySelectorAll(".country." + pais);
    const activeCountrySelectedMouse = document.querySelectorAll(`.country-select-mouse.${pais}`);
    activeCountry.forEach(element => {
      element.classList.add(activeClass);
    });
    activeCountrySelectedMouse[0].classList.add(activeClass);
  }

  // Função para manipular a seleção de países no mapa
  function handleMap(pais) {
    // Remove a classe 'active' de todos os elementos .country e .country-select-mouse
    countryElements.forEach(el => el.classList.remove(activeClass));
    countrySelectMouseElements.forEach(el => el.classList.remove(activeClass));

    // Adiciona a classe 'active' ao país correspondente
    addActiveClassCountry(pais);
  }

  // Função para posicionar os países no mapa
  function setCountryPositions() {
    const mapRect = map.getBoundingClientRect();
    countryPathElements.forEach((countryPath) => {
      const elementClass = [...countryPath.classList];
      const elementRect = countryPath.getBoundingClientRect();
      const leftPercentage = ((elementRect.left - mapRect.left + (elementRect.width / 2)) / map.clientWidth) * 100;
      const topPercentage = ((elementRect.top - mapRect.top + (elementRect.height / 2)) / map.clientHeight) * 100;
      const country = document.querySelector(`div.${elementClass[1]}`);
      if (country !== null) {
        country.style.left = `${leftPercentage}%`;
        country.style.top = `${topPercentage}%`;
      }
    });
  }

  // Adiciona os event listeners aos elementos countrySelectMouse
  countrySelectMouseElements.forEach(element => {
    element.addEventListener("mouseover", function () {
      handleMap(this.getAttribute("data-pais"));
    });
    element.addEventListener("focus", function () {
      handleMap(this.getAttribute("data-pais"));
    });
  });
  

  // Atualiza as posições no carregamento inicial e em redimensionamentos
  window.addEventListener('resize', setCountryPositions);
  setCountryPositions();

  // Configuração e manipulação do Splide.js
  if (document.querySelector('.splideMapa')) {
    let splideMapa = new Splide('.splideMapa', {
      type: 'loop',
      arrows: true,
      autoplay: true,
      pagination: false,
      breakpoints: {
        991: {
          grid: {
            rows: 1,
            cols: 1,
            gap: {
              row: '.5rem',
              col: '2rem'
            }
          }
        }
      }
    });

    let sliderMounted = false;

    function updateSelectedCountry() {
      const activeSlide = splideMapa.Components.Elements.slides[splideMapa.index];
      const pais = activeSlide.getAttribute('data-pais');
      if (pais) {
        handleMap(pais);
      }
    }
    
    splideMapa.on('mounted', updateSelectedCountry);
    splideMapa.on('moved', function (newIndex) {
      var currentSlide = splideMapa.Components.Elements.slides[newIndex];
      var pais = currentSlide.getAttribute('data-pais');
      if (pais) {
        handleMap(pais);
      }
    });

    function checkWindowWidth() {
      if (window.matchMedia("(max-width: 991px)").matches && !sliderMounted) {
        splideMapa.mount(window.splide.Extensions);
        sliderMounted = true;
      } else if (!window.matchMedia("(max-width: 991px)").matches && sliderMounted) {
        splideMapa.destroy();
        sliderMounted = false;
      }
    }

    checkWindowWidth();
    window.addEventListener('resize', checkWindowWidth);
  }
});
