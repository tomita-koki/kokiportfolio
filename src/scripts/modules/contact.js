export function initContact() {
  const form = document.querySelector('[data-contact-form]');
  const dialog = document.querySelector('[data-confirmation]');
  if (!form || !dialog) return;
  form.addEventListener('submit', (event) => {
    event.preventDefault();
    const data = new FormData(form);
    for (const key of ['name', 'email', 'message']) {
      const field = form.elements.namedItem(key);
      field.setCustomValidity(String(data.get(key)).trim() ? '' : '入力してください。');
      field.addEventListener('input', () => field.setCustomValidity(''), { once: true });
    }
    if (!form.reportValidity()) return;
    for (const key of ['name', 'email', 'message'])
      dialog.querySelector('[data-confirm-' + key + ']').textContent = data.get(key);
    dialog.showModal();
  });
  dialog.querySelector('[data-confirm-close]')?.addEventListener('click', () => dialog.close());
}
