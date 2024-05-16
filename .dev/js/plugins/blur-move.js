const elementosPais = document.querySelectorAll('[data-blur="hover"]');

elementosPais.forEach(elementoPai => {
  const elementoSeguidor = elementoPai.querySelector('[data-blur="move"]');
  
  elementoPai.addEventListener('mousemove', (event) => {
    const xRelativo = event.clientX - elementoPai.getBoundingClientRect().left;
    const yRelativo = event.clientY - elementoPai.getBoundingClientRect().top;
    
    elementoSeguidor.style.left = xRelativo + 'px';
    elementoSeguidor.style.top = yRelativo + 'px';
  });
});
