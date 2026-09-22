const DURATION = 450;
const EASING = 'cubic-bezier(0.22, 1, 0.36, 1)';
const reducedMotion = matchMedia('(prefers-reduced-motion: reduce)');
const running = new WeakMap();

function setOpen(details, open) {
  if (details.open === open && !running.has(details)) return;
  const from = details.offsetHeight;
  running.get(details)?.cancel();
  details.open = open;
  const to = details.offsetHeight;
  if (reducedMotion.matches) return;
  details.open = true;
  details.classList.toggle('faq__item--closing', !open);
  details.style.overflow = 'hidden';
  const animation = details.animate(
    { blockSize: [`${from}px`, `${to}px`] },
    { duration: DURATION, easing: EASING },
  );
  const content = [...details.children].filter((child) => child.tagName !== 'SUMMARY');
  const fade = content.map((el) =>
    el.animate(
      {
        opacity: open ? [0, 1] : [1, 0],
        translate: open ? ['0 -0.5rem', '0 0'] : ['0 0', '0 -0.5rem'],
      },
      {
        duration: DURATION * 0.6,
        delay: open ? DURATION * 0.2 : 0,
        easing: 'ease-out',
        fill: 'both',
      },
    ),
  );
  running.set(details, animation);
  animation.onfinish = () => {
    details.open = open;
    details.classList.remove('faq__item--closing');
    details.style.overflow = '';
    fade.forEach((f) => f.cancel());
    running.delete(details);
  };
  animation.oncancel = () => fade.forEach((f) => f.cancel());
}

export function initFaq() {
  const list = document.querySelector('[data-faq]');
  if (!list) return;
  list.querySelectorAll('details').forEach((details) => {
    details.querySelector('summary').addEventListener('click', (event) => {
      event.preventDefault();
      const closing = details.classList.contains('faq__item--closing');
      setOpen(details, closing || !details.open);
    });
  });
  document.querySelectorAll('[data-faq-link]').forEach((link) =>
    link.addEventListener('click', () => {
      const target = document.querySelector(link.getAttribute('href'));
      if (target) setOpen(target, true);
    }),
  );
}
