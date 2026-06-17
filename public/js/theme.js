(function () {
  function applyTheme(theme) {
    if (!theme) theme = 'light';
    document.documentElement.setAttribute('data-theme', theme);
    document.body.classList.toggle('dark-mode', theme === 'dark');
  }

  // Función global para botones existentes (sin duplicar lógica en cada vista)
  window.toggleDarkMode = function () {
    const current = localStorage.getItem('theme') || 'light';
    const next = current === 'dark' ? 'light' : 'dark';
    localStorage.setItem('theme', next);
    applyTheme(next);
  };


  function loadTheme() {
    let theme = localStorage.getItem('theme');

    // Compatibilidad con el sistema anterior
    if (!theme) {
      const modo = localStorage.getItem('modo');
      if (modo === 'oscuro') theme = 'dark';
      if (modo === 'claro') theme = 'light';
    }

    if (!theme) theme = 'light';

    applyTheme(theme);
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', loadTheme, { once: true });
  } else {
    loadTheme();
  }
})();

