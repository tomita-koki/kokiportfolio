import { gsap } from 'gsap';

// Radius is measured in viewport pixels, keeping the aperture circular on every screen.
export function getCoverRadius(width, height) {
  return Math.hypot(width, height) / 2 + 4;
}

export function initLoading() {
  const root = document.documentElement;
  const overlay = document.querySelector('[data-loading]');
  if (!overlay || !root.classList.contains('loading-active')) return;

  const surface = overlay.querySelector('[data-loading-surface]');
  const hole = overlay.querySelector('[data-loading-hole]');
  const rings = [...overlay.querySelectorAll('[data-loading-ring]')];
  const progress = overlay.querySelector('[data-loading-progress]');
  const label = overlay.querySelector('[data-loading-label]');
  const value = overlay.querySelector('[data-loading-value]');
  const accessible = overlay.querySelector('[data-loading-accessible]');
  const background = [...document.querySelectorAll('[data-hero-background]')];
  const content = [...document.querySelectorAll('[data-hero-enter]')];
  const preference = matchMedia('(prefers-reduced-motion: reduce)');
  const locked = [...document.body.children].filter(
    (element) => element !== overlay && element.tagName !== 'SCRIPT' && !element.inert,
  );
  locked.forEach((element) => { element.inert = true; });

  const baseRadius = 56;
  const stroke = 3;
  const circumference = 2 * Math.PI * baseRadius;
  const state = { percent: 0, opening: 0, zoom: 0 };
  let finished = false;
  let tracking = true;
  let timeline;
  let deadline;
  let width;
  let height;

  function draw() {
    const innerRadius = baseRadius - stroke / 2;
    const scale = 1 + (getCoverRadius(width, height) / innerRadius - 1) * state.zoom;
    hole.setAttribute('r', innerRadius * scale * state.opening);
    rings.forEach((ring) => {
      ring.setAttribute('r', baseRadius * scale);
      ring.setAttribute('stroke-width', stroke * scale);
    });
    const length = circumference * scale;
    progress.style.strokeDasharray = `${length}`;
    progress.style.strokeDashoffset = `${length * (1 - state.percent / 100)}`;
    value.textContent = `${Math.floor(state.percent)}%`;
    accessible.value = Math.floor(state.percent);
  }

  function resize() {
    ({ width, height } = overlay.getBoundingClientRect());
    surface.setAttribute('viewBox', `0 0 ${width} ${height}`);
    [hole, ...rings].forEach((circle) => {
      circle.setAttribute('cx', width / 2);
      circle.setAttribute('cy', height / 2);
    });
    progress.setAttribute('transform', `rotate(-90 ${width / 2} ${height / 2})`);
    draw();
  }

  function finish() {
    if (finished) return;
    finished = true;
    clearTimeout(deadline);
    timeline?.kill();
    gsap.killTweensOf(state);
    gsap.set([...background, ...content], { clearProps: 'opacity,visibility,transform' });
    root.classList.remove('loading-active');
    locked.forEach((element) => { element.inert = false; });
    overlay.remove();
    window.removeEventListener('resize', resize);
    window.removeEventListener('pageshow', restore);
    preference.removeEventListener('change', finish);
    document.removeEventListener('loading-timeout', finish);
  }

  function restore(event) {
    if (event.persisted) finish();
  }

  window.addEventListener('resize', resize);
  window.addEventListener('pageshow', restore);
  preference.addEventListener('change', finish);
  document.addEventListener('loading-timeout', finish);
  resize();

  function reveal() {
    if (finished) return;
    tracking = false;
    gsap.killTweensOf(state);
    const reduced = preference.matches;
    gsap.set(background, { scale: reduced ? 1 : 1.12 });
    gsap.set(content, { autoAlpha: 0, y: reduced ? 0 : 16 });
    timeline = gsap.timeline({ onComplete: finish });
    timeline
      .to(state, { percent: 100, duration: 0.25, ease: 'none', onUpdate: draw })
      .to(label, { opacity: 0, duration: 0.18 }, '+=0.2');

    if (reduced) {
      timeline
        .to(overlay, { opacity: 0, duration: 0.2 })
        .to(content, { autoAlpha: 1, duration: 0.2, stagger: 0 }, '<');
      return;
    }

    timeline
      .to(state, { opening: 1, duration: 0.12, ease: 'power1.out', onUpdate: draw })
      .addLabel('zoom')
      .to(state, { zoom: 1, duration: 1, ease: 'power3.inOut', onUpdate: draw }, 'zoom')
      .to(background, { scale: 1, duration: 1, ease: 'power3.inOut' }, 'zoom')
      .to(content, {
        autoAlpha: 1,
        y: 0,
        duration: 0.5,
        stagger: 0.1,
        ease: 'power2.out',
      }, 'zoom+=0.8');
  }

  // Track resources needed by the FV; failed resources also settle, so loading cannot hang.
  const hero = document.querySelector('[data-hero]');
  const resources = [...hero.querySelectorAll('img')].map((image) => image.decode().catch(() => {}));
  hero.querySelectorAll('[data-hero-background] [class*="hero__shape"]').forEach((element) => {
    const url = getComputedStyle(element).backgroundImage.match(/url\(["']?(.*?)["']?\)/)?.[1];
    if (!url) return;
    const image = new Image();
    image.src = url;
    resources.push(image.decode().catch(() => {}));
  });
  resources.push(document.fonts.ready);
  let settled = 0;
  const ready = Promise.allSettled(resources.map((resource) => resource.finally(() => {
    settled += 1;
    if (!finished && tracking) gsap.to(state, {
      percent: Math.min(95, settled / resources.length * 95),
      duration: 0.25,
      overwrite: true,
      onUpdate: draw,
    });
  })));
  const timeout = new Promise((resolve) => { deadline = setTimeout(resolve, 8000); });
  Promise.race([ready, timeout]).then(() => {
    clearTimeout(deadline);
    reveal();
  });
}
