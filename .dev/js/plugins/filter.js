const setupPaginationAndFilters = (containerSelector, itemsSelector, filtersSelector, prevButtonSelector, nextButtonSelector, pageIndicatorSelector, items) => {
  const itemsPerPage = items ? items : 4;
  const buttons = document.querySelectorAll(filtersSelector + ' button');
  const boatItems = Array.from(document.querySelectorAll(itemsSelector));
  const prevPageButton = document.querySelector(prevButtonSelector);
  const nextPageButton = document.querySelector(nextButtonSelector);
  const pageIndicator = document.querySelector(pageIndicatorSelector);
  const activeClass = 'active';
  let currentPage = 1;
  let filteredItems = [...boatItems];

  const renderItems = () => {
    boatItems.forEach(item => item.style.display = 'none');
    const startIndex = (currentPage - 1) * itemsPerPage;
    const endIndex = startIndex + itemsPerPage;
    filteredItems.slice(startIndex, endIndex).forEach(item => item.style.display = 'block');
    const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
    
    if (pageIndicator) pageIndicator.innerHTML = `<span class="t-secondary">${currentPage}</span> / ${totalPages}`;

    // Adicionar classe active aos itens visíveis
    boatItems.forEach(item => item.classList.remove(activeClass));
    filteredItems.slice(startIndex, endIndex).forEach(item => item.classList.add(activeClass));

    // Atualizar visibilidade dos botões de paginação
    if(prevPageButton) prevPageButton.disabled = currentPage === 1;
    if(nextPageButton) nextPageButton.disabled = currentPage === totalPages;
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
  if(prevPageButton) {
    prevPageButton.addEventListener('click', () => {
      if (currentPage > 1) {
        currentPage--;
        renderItems();
      }
    });
  }

  if(nextPageButton) {
    nextPageButton.addEventListener('click', () => {
      const totalPages = Math.ceil(filteredItems.length / itemsPerPage);
      if (currentPage < totalPages) {
        currentPage++;
        renderItems();
      }
    });
  }

  renderItems(); // Initial render
};