export function initHeroMotion() {
  const stage = document.querySelector('[data-hero-shapes]');
  // Distribute the circles across the backdrop, then vary their sizes and motion.
  // The first SP_COUNT anchors are shown on SP; the rest are PC only.
  const SP_COUNT = 5;
  const YELLOW = new Set([0, 4, 5]);
  const anchors = [
    [55, 4],
    [89, 74],
    [3, 82],
    [13, 9],
    [78, 13],
    [43, 76],
    [4, 49],
    [66, 53],
  ];
  if (!stage) return;
  const shapes = anchors.map(([x, y], index) => {
    const shape = document.createElement('span');
    shape.className = index < SP_COUNT ? 'hero__shape' : 'hero__shape hero__shape--pc';
    shape.style.setProperty('--circle-size', `${Math.round(48 + Math.random() * 160)}px`);
    shape.style.left = `${x}%`;
    shape.style.top = `${y}%`;
    shape.style.backgroundColor = YELLOW.has(index)
      ? 'rgb(248 221 160 / 25%)'
      : 'rgb(50 118 170 / 6%)';
    stage.append(shape);
    return shape;
  });
  const motion = shapes.map((_, index) => ({
    duration: 10000 + Math.random() * 6000,
    radius: 40 + Math.random() * 32,
    phase: anchors[index][0] > 50 ? 0 : Math.PI,
  }));

  const preference = matchMedia('(prefers-reduced-motion: reduce)');
  let animations = [];
  function play() {
    animations.forEach((animation) => animation.cancel());
    animations = [];
    if (preference.matches) return;
    shapes.forEach((shape, index) => {
      const { duration, radius, phase } = motion[index];
      const frames = Array.from({ length: 121 }, (_, step) => {
        const angle = (step / 120) * Math.PI * 2;
        const x = (Math.cos(angle + phase) - Math.cos(phase)) * radius;
        const y = (Math.sin(angle + phase) - Math.sin(phase)) * radius * 0.8;
        const scale = 1 + Math.sin(angle) * 0.1;
        return { transform: `translate(${x}px, ${y}px) scale(${scale})` };
      });
      animations.push(
        shape.animate(
          [
            { opacity: 0, transform: 'translateY(48px) scale(.65)' },
            { opacity: 1, transform: 'translateY(0) scale(1)' },
          ],
          {
            duration: 1400,
            delay: index * 180,
            easing: 'cubic-bezier(.22,1,.36,1)',
            fill: 'backwards',
          },
        ),
      );
      animations.push(
        shape.animate(frames, {
          duration,
          iterations: Infinity,
          delay: 1400 + index * 180,
          easing: 'linear',
        }),
      );
    });
  }

  preference.addEventListener('change', play);
  play();
}
