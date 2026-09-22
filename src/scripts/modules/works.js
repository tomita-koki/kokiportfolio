import Swiper from 'swiper';
import { Navigation, Keyboard, A11y } from 'swiper/modules';

export function initWorks() {
  const element = document.querySelector('[data-works]');
  if (!element) return;
  const count = document.querySelector('[data-works-count]');
  const total = element.querySelectorAll('.swiper-slide').length;
  if (!total) return;
  const originalSlides = [...element.querySelectorAll('.swiper-slide')];
  const wrapper = element.querySelector('.swiper-wrapper');
  let slider;
  let columns = 0;
  const update = (swiper) => {
    const visibleCount = Math.min(total, Number(swiper.params.slidesPerView));
    const indices = Array.from({ length: visibleCount }, (_, i) => (swiper.realIndex + i) % total);
    if (count) {
      count.textContent =
        indices.map((index) => String(index + 1).padStart(2, '0')).join('・') +
        ' / ' +
        String(total).padStart(2, '0');
    }
    swiper.slides.forEach((slide) => {
      const index = originalSlides.indexOf(slide);
      slide.querySelectorAll('a').forEach((link) => {
        link.tabIndex = indices.includes(index) ? 0 : -1;
      });
    });
  };
  const initialize = () => {
    // The slider has 12px padding on each side for the hover zoom and focus outlines.
    const width = element.clientWidth - 24;
    const nextColumns = Math.max(1, Math.min(3, total, Math.floor((width + 24) / 324)));
    if (nextColumns === columns) return;
    const activeIndex = slider?.realIndex ?? 0;
    slider?.destroy(true, true);
    // Loop mode rearranges nodes; restore their editorial order before rebuilding.
    originalSlides.forEach((slide) => wrapper.append(slide));
    document.querySelectorAll('[data-works-prev], [data-works-next]').forEach((button) => {
      button.disabled = false;
      button.removeAttribute('aria-disabled');
    });
    columns = nextColumns;
    slider = new Swiper(element, {
      modules: [Navigation, Keyboard, A11y],
      slidesPerView: columns,
      slidesPerGroup: 1,
      initialSlide: Math.min(activeIndex, total - columns),
      loop: total > columns,
      loopAddBlankSlides: false,
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
      on: { init: update, slideChange: update, loopFix: update },
    });
  };
  initialize();
  new ResizeObserver(initialize).observe(element);
}
