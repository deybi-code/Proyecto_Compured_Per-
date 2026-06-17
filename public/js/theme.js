/**
 * Controlador único y global del modo oscuro / claro.
 * Se usa en TODAS las páginas (home, carrito, categoría, producto,
 * búsqueda, seguimiento, nosotros, términos) para que el cambio de
 * tema quede sincronizado entre apartados a través de localStorage.
 *
 * Aplica DOS mecanismos a la vez para mantener compatibilidad con
 * los dos estilos de CSS que ya existen en el proyecto:
 *   1. atributo  data-theme="dark"  en <html>  (usado por carrito y
 *      cualquier vista basada en variables CSS).
 *   2. clase     .dark-mode         en <body>  (usado por styles.css:
 *      .dark-mode .topbar, .dark-mode .card, .dark-mode .cat-sidebar, etc.)
 *
 * Importante: este script se carga en el <head>, ANTES de que exista
 * <body>. Por eso el atributo en <html> se aplica de inmediato (evita
 * el parpadeo de tema claro), y la clase en <body> se aplica apenas
 * el DOM esté listo si todavía no existe.
 */
(function () {

    function actualizarIcono(theme) {
        const isDark = theme === 'dark';

        // Convención A: <i id="theme-icon" class="fas fa-moon"></i> + <span id="theme-text">
        const icon = document.getElementById('theme-icon');
        const text = document.getElementById('theme-text');
        if (icon) icon.className = isDark ? 'fas fa-sun' : 'fas fa-moon';
        if (text) text.textContent = isDark ? 'Claro' : 'Oscuro';

        // Convención B: <span id="themeIcon">🌙</span> (carrito y páginas sin Font Awesome)
        const emoji = document.getElementById('themeIcon');
        if (emoji) emoji.textContent = isDark ? '☀️' : '🌙';
    }

    function aplicarClaseBody(theme) {
        if (!document.body) return;
        document.body.classList.toggle('dark-mode', theme === 'dark');
    }

    function aplicarTema(theme) {
        if (theme === 'dark') {
            document.documentElement.setAttribute('data-theme', 'dark');
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.removeAttribute('data-theme');
            document.documentElement.classList.remove('dark');
        }
        aplicarClaseBody(theme);
        actualizarIcono(theme);
    }

    const temaGuardado = localStorage.getItem('theme') === 'dark' ? 'dark' : 'light';

    // Atributo en <html>: se puede aplicar de inmediato, sin esperar al <body>.
    aplicarTema(temaGuardado);

    // Si el <body> aún no existía (script cargado en <head>), reaplicamos
    // en cuanto el DOM esté listo para que la clase .dark-mode no se pierda.
    if (!document.body) {
        document.addEventListener('DOMContentLoaded', function () {
            aplicarTema(temaGuardado);
        });
    }

    function cambiarTema() {
        const actual = document.documentElement.getAttribute('data-theme') === 'dark' ? 'dark' : 'light';
        const nuevo = actual === 'dark' ? 'light' : 'dark';
        localStorage.setItem('theme', nuevo);
        aplicarTema(nuevo);
        document.dispatchEvent(new Event('theme:changed'));
    }

    // Se exponen ambos nombres porque distintas vistas del proyecto
    // ya usan uno u otro en su onclick="...".
    window.toggleTheme = cambiarTema;
    window.toggleDarkMode = cambiarTema;

})();
