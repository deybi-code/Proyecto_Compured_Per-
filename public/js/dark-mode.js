/**
 * dark-mode.js
 * Coloca este script en: public/js/dark-mode.js
 * Y llámalo en tu layout: <script src="{{ asset('js/dark-mode.js') }}" defer></script>
 *
 * También debes tener en tailwind.config.js:  darkMode: 'class'
 */

(function () {
    const html   = document.documentElement;
    const CLAVE  = 'tema'; // clave en localStorage

    // Aplicar tema guardado ANTES de que la página pinte (evita flash)
    const temaGuardado = localStorage.getItem(CLAVE);
    if (temaGuardado === 'dark') {
        html.classList.add('dark');
    } else if (!temaGuardado) {
        // Si no hay preferencia guardada, usar la del sistema operativo
        if (window.matchMedia('(prefers-color-scheme: dark)').matches) {
            html.classList.add('dark');
        }
    }

    // Activar el botón cuando el DOM esté listo
    document.addEventListener('DOMContentLoaded', function () {
        const btn = document.getElementById('theme-toggle');
        if (!btn) return;

        btn.addEventListener('click', function () {
            if (html.classList.contains('dark')) {
                html.classList.remove('dark');
                localStorage.setItem(CLAVE, 'light');
            } else {
                html.classList.add('dark');
                localStorage.setItem(CLAVE, 'dark');
            }
        });
    });
})();
