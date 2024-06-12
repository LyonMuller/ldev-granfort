// @koala-prepend "plugins/filter.js"
document.addEventListener('DOMContentLoaded', function () {

  setupPaginationAndFilters(
    '.container',
    '.boat-item-cont',
    '.filters',
    '#prev-page',
    '#next-page',
    '#page-indicator',
    -1
  );
});