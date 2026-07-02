// theme.js — aplica el tema ANTES de pintar la página (evita flash)
(function () {
    const theme = localStorage.getItem('theme') || localStorage.getItem('cpTheme');
    const isDark = theme === 'dark';
    document.documentElement.setAttribute('data-theme', isDark ? 'dark' : 'light');
    document.documentElement.classList.toggle('dark', isDark);
})();
