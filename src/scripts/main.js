import { initHamburger } from './modules/hamburger.js';
import { initWorks } from './modules/works.js';
import { initContact } from './modules/contact.js';
initHamburger();
initWorks();
initContact();
document.querySelectorAll('[data-faq-link]').forEach((link) =>
  link.addEventListener('click', () => {
    const target = document.querySelector(link.getAttribute('href'));
    if (target) target.open = true;
  }),
);
const backTop = document.querySelector('[data-back-top]');
if (backTop) {
  const update = () => {
    backTop.hidden = window.scrollY < 400;
  };
  window.addEventListener('scroll', update, { passive: true });
  update();
}
