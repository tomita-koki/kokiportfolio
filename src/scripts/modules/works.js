import Swiper from 'swiper';
import { Navigation, Keyboard, A11y } from 'swiper/modules';
export function initWorks() {
  const element = document.querySelector('[data-works]');
  if (!element) return;
  const count = document.querySelector('[data-works-count]');
  const update = (swiper) => {
    const start = swiper.activeIndex + 1;
    const end = Math.min(3, start + Number(swiper.params.slidesPerView) - 1);
    if (count)
      count.textContent =
        (start === end
          ? String(start).padStart(2, '0')
          : String(start).padStart(2, '0') + '–' + String(end).padStart(2, '0')) + ' / 03';
    swiper.slides.forEach((slide, index) => {
      const link = slide.querySelector('a');
      if (link) link.tabIndex = index >= start - 1 && index < end ? 0 : -1;
    });
  };
  new Swiper(element, {
    modules: [Navigation, Keyboard, A11y],
    slidesPerView: 1,
    spaceBetween: 24,
    speed: matchMedia('(prefers-reduced-motion: reduce)').matches ? 0 : 350,
    watchOverflow: true,
    keyboard: { enabled: true, onlyInViewport: true },
    navigation: { prevEl: '[data-works-prev]', nextEl: '[data-works-next]' },
    a11y: {
      prevSlideMessage: '前の制作実績',
      nextSlideMessage: '次の制作実績',
      slideLabelMessage: '{{index}} / {{slidesLength}}',
    },
    breakpoints: { 769: { slidesPerView: 2 }, 1025: { slidesPerView: 3 } },
    on: { init: update, slideChange: update, breakpoint: update, resize: update },
  });
}
