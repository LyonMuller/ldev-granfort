// script.js

document.addEventListener('DOMContentLoaded', () => {
  const sections = document.querySelectorAll('section');
  const navLinksContainer = document.getElementById('nav-links');

  // Create navigation links dynamically
  sections.forEach(section => {
    const id = section.getAttribute('id');
    if (id) { // Ensure the section has an ID
      const link = document.createElement('a');
      link.href = `#${id}`;
      link.textContent = section.getAttribute('data-section');
      const listItem = document.createElement('li');
      listItem.appendChild(link);
      navLinksContainer.appendChild(listItem);
    }
  });

  const options = {
    threshold: .3 // Trigger when 50% of the section is in view
  };

  const observer = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      const id = entry.target.getAttribute('id');
      if (entry.isIntersecting) {
        const link = document.querySelector(`nav ul li a[href="#${id}"]`);
        if (link) link.classList.add('active');
      } else {
        const link = document.querySelector(`nav ul li a[href="#${id}"]`);
        if (link) link.classList.remove('active');
      }
    });
  }, options);

  sections.forEach(section => {
    observer.observe(section);
  });
});

let lastScrollTopBoat = 0;

function handleNavBoat() {
  const nav = document.querySelector('.nav-boat-menu');
  const navbarHeight = document.querySelector('.navbar-fixed-top').offsetHeight;
  const bannerHeight = window.innerHeight; 
  const scrollTop = window.scrollY || document.documentElement.scrollTop;

  if (scrollTop < (bannerHeight - navbarHeight) || scrollTop > lastScrollTopBoat) {
    nav.style.transform = 'translateY(0)';
  } else {
    nav.style.transform = `translateY(${navbarHeight}px)`;
  }

  lastScrollTopBoat = scrollTop <= 0 ? 0 : scrollTop;
}

handleNavBoat();
window.addEventListener('scroll', handleNavBoat);