/**
 * ハンバーガーメニュー
 * - [data-nav-toggle] クリックで [data-nav] を開閉
 * - Esc キー・ナビ内リンククリック・PC 幅への切替で閉じる
 */
export function initHamburger() {
  const toggle = document.querySelector('[data-nav-toggle]');
  const nav = document.querySelector('[data-nav]');
  if (!toggle || !nav) return;

  const mql = window.matchMedia('(min-width: 1024px)');

  const setOpen = (isOpen) => {
    nav.classList.toggle('is-open', isOpen);
    toggle.setAttribute('aria-expanded', String(isOpen));
    toggle.setAttribute('aria-label', isOpen ? 'メニューを閉じる' : 'メニューを開く');
    document.body.style.overflow = isOpen ? 'hidden' : '';
  };

  toggle.addEventListener('click', () => {
    setOpen(toggle.getAttribute('aria-expanded') !== 'true');
  });

  nav.addEventListener('click', (event) => {
    if (event.target.closest('a')) setOpen(false);
  });

  document.addEventListener('keydown', (event) => {
    if (event.key === 'Escape') setOpen(false);
  });

  mql.addEventListener('change', (event) => {
    if (event.matches) setOpen(false);
  });
}
