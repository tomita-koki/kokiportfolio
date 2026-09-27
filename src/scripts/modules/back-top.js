// Fade the back-to-top button in once the hero (FV) has scrolled out of view.
export function initBackTop() {
  const button = document.querySelector('[data-back-top]');
  const hero = document.querySelector('[data-hero]');
  if (!button) return;
  if (!hero) {
    button.classList.add('back-top--visible');
    return;
  }
  if (!('IntersectionObserver' in window)) {
    const update = () => {
      button.classList.toggle('back-top--visible', window.scrollY >= hero.offsetHeight);
    };
    window.addEventListener('scroll', update, { passive: true });
    window.addEventListener('resize', update);
    update();
    return;
  }
  const observer = new IntersectionObserver(
    ([entry]) => {
      button.classList.toggle('back-top--visible', !entry.isIntersecting);
    },
    { threshold: 0 },
  );
  observer.observe(hero);
}
