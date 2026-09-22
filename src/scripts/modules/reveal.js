// Fade each section in the first time it scrolls into view.
export function initReveal() {
  const targets = document.querySelectorAll('[data-reveal]');
  if (!targets.length) return;
  if (!('IntersectionObserver' in window)) {
    targets.forEach((target) => target.classList.add('reveal--visible'));
    return;
  }
  const observer = new IntersectionObserver(
    (entries) => {
      entries.forEach((entry) => {
        if (!entry.isIntersecting) return;
        entry.target.classList.add('reveal--visible');
        observer.unobserve(entry.target);
      });
    },
    { rootMargin: '0px 0px -15% 0px', threshold: 0 },
  );
  targets.forEach((target) => observer.observe(target));
}
