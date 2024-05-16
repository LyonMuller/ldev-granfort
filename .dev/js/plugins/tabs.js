document.querySelectorAll('[data-group]').forEach(group => {
  const allTargets = group.querySelectorAll('[data-tg]');
  const allClicks = group.querySelectorAll('[data-click]');
  const activeClass = 'active';

  if(!allTargets && !allClicks) return;

  allTargets[0].classList.add(activeClass);
  allClicks[0].classList.add(activeClass);

  allClicks.forEach(clickElement => {
    clickElement.addEventListener('click', function (e) {
      e.preventDefault();

      const id = this.getAttribute('data-click');
      const target = group.querySelector(`[data-tg="${id}"]`);

      allClicks.forEach(click => click.classList.remove(activeClass));
      allTargets.forEach(tg => tg.classList.remove(activeClass));

      target.classList.add(activeClass);
      this.classList.add(activeClass);
    });
  });
});
