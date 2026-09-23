import { initHamburger } from './modules/hamburger.js';
import { initWorks } from './modules/works.js';
import { initContact } from './modules/contact.js';
import { initFaq } from './modules/faq.js';
import { initReveal } from './modules/reveal.js';
import { initLoading } from './modules/loading.js';
initLoading();
initHamburger();
initWorks();
initContact();
initFaq();
initReveal();
const backTop = document.querySelector('[data-back-top]');
if (backTop) {
  const update = () => {
    backTop.hidden = window.scrollY < 400;
  };
  window.addEventListener('scroll', update, { passive: true });
  update();
}
const header = document.querySelector('.header');
const hero = document.querySelector('.hero');
if (header && hero) {
  const update = () => {
    header.classList.toggle('header--visible', window.scrollY >= hero.offsetHeight);
  };
  window.addEventListener('scroll', update, { passive: true });
  window.addEventListener('resize', update);
  update();
}

