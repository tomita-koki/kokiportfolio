/** [data-year] に現在の西暦を入れる */
export function initCopyrightYear() {
  document.querySelectorAll('[data-year]').forEach((el) => {
    el.textContent = String(new Date().getFullYear());
  });
}
