import { initHamburger } from './modules/hamburger.js';
import { initWorks } from './modules/works.js';
import { initContact } from './modules/contact.js';
import { initFaq } from './modules/faq.js';
import { initReveal } from './modules/reveal.js';
import { initLoading } from './modules/loading.js';
import { initBackTop } from './modules/back-top.js';
initLoading();
initHamburger();
initWorks();
initContact();
initFaq();
initReveal();
initBackTop();
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

