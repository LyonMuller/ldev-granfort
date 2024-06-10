// @koala-prepend "plugins/wow.min.js"

const wow = new WOW({
  boxClass: 'wow', // animated element css class (default is wow)
  animateClass: 'animate__animated', // animation css class (default is animated)
  offset: 100, // distance to the element when triggering the animation (default is 0)
  mobile: true, // trigger animations on mobile devices (default is true)
  live: true, // act on asynchronously loaded content (default is true)
  scrollContainer: null, // optional scroll container selector, otherwise use window,
  resetAnimation: false, // reset animation on end (default is true)
  callback: function (box) {
    let time = box.getAttribute('data-wow-delay') ? box.getAttribute('data-wow-delay') : '';
    if(time){
      time = time.replace('s', '') * 1000
      setTimeout(() => {
        box.classList.add('animated');
      }, time);
    }else {
      box.classList.add('animated');
    }
  }
});
wow.init();

let lastScrollTop = 0;

function handleNav() {
  const nav = document.querySelector('.navbar-fixed-top');
  const navClass = 'bg-white';
  const transformClass = 'transform-nav';
  const scrollTop = window.scrollY || document.documentElement.scrollTop;

  if (scrollTop > 30 && scrollTop > lastScrollTop) {
    nav.classList.add(transformClass);
  } else {
    nav.classList.remove(transformClass);
  }
  if(scrollTop > 30){
    nav.classList.add(navClass);
  } else {
    nav.classList.remove(navClass);
  }

  lastScrollTop = scrollTop <= 0 ? 0 : scrollTop; // Para casos em que o scroll é rápido demais
}
handleNav();

window.addEventListener('scroll', handleNav);

function handleCookie() {
  const popupCookie = document.querySelector('.popup-cookie');
  const popupCookieBtn = document.querySelector('.popup-cookie__btn');
  
  if(popupCookie === null && popupCookieBtn === null) return;
  
  popupCookieBtn.addEventListener('click', function() {
    localStorage.setItem('cookie', 'aceito');
    popupCookie.classList.add('d-none');
  });
  if(localStorage.getItem('cookie') === 'aceito') {
    popupCookie.classList.add('d-none');
  }
  if(localStorage.getItem('cookie') === null) {
    popupCookie.classList.remove('d-none');
  }
}
 
document.addEventListener('DOMContentLoaded', () => {
  handleCookie();

  // show toggle .boat-links on .category-title click
  const categoryTitle = document.querySelectorAll('.category-title');
  const boatContainer = document.querySelector('.boat-container');
  const boatLinks = document.querySelectorAll('.boat-links .nav-link');
    
  categoryTitle.forEach((title) => {
    title.addEventListener('click', function() {
      const boatLinksCont = this.nextElementSibling; // Assumindo que .boat-links é o próximo elemento
      const isTitleOpen = this.classList.contains('show');
      const openTitles = document.querySelectorAll('.category-title.show');
  
      // Verifica se o título clicado é o único aberto
      if (isTitleOpen && openTitles.length === 1) return;
  
      // Remove a classe 'show' de todos os títulos e contêineres de links de barcos
      categoryTitle.forEach((t) => t.classList.remove('show'));
  
      // Adiciona a classe 'show' apenas ao título e contêiner de links de barco clicados
      this.classList.add('show');
    });
  });

  boatLinks.forEach((link) => {
    link.addEventListener('mouseover', function() {
      const bg = this.getAttribute('data-bg');
      const text = this.textContent;
      const bgUrl = `url(${bg})`;
      
      boatContainer.querySelector('.title-boat').setAttribute('data-text', text);
      boatContainer.style.setProperty('--bg', bgUrl);
    })
  });


  // Delegação de eventos para dropdowns
  document.addEventListener('click', e => {
    const toggle = e.target.closest('[data-toggle="dropdown"]');
    if (!toggle) return;

    e.preventDefault();
    const expanded = toggle.getAttribute('aria-expanded') === 'true';
    toggle.setAttribute('aria-expanded', !expanded);
    const dropdownMenu = toggle.parentNode.querySelector('.dropdown-menu');
    dropdownMenu.classList.toggle('show');
  });

  // Navegação suave para links de âncora
  document.addEventListener('click', e => {
    const link = e.target.closest('a[href*="#"]:not(.normal-click)');
    if (!link) return;
    if (link.getAttribute('href') === '#') return;
    if (location.pathname.replace(/^\//, '') === link.pathname.replace(/^\//, '') && location.hostname === link.hostname) {
      e.preventDefault();
      const target = document.querySelector(link.hash);
      if (!target) return;

      const offsetTop = target.offsetTop - 110;
      window.scrollTo({
        top: offsetTop,
        behavior: 'smooth'
      });
    }
  });
});
