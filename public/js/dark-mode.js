/**
 * dark-mode.js — Compured Perú
 * Aplica el tema ANTES de que el navegador pinte la página (evita flash).
 * Compatible con AMBOS sistemas: data-theme (home/public) y clase .dark (admin/Tailwind).
 */
(function () {
    // Leer preferencia guardada; si no hay, detectar preferencia del sistema operativo
    const saved       = localStorage.getItem('theme');
    const prefersDark = window.matchMedia('(prefers-color-scheme: dark)').matches;
    const theme       = saved || (prefersDark ? 'dark' : 'light');

    // ── Sistema 1: atributo data-theme (usado por layouts main.blade.php / home) ──
    document.documentElement.setAttribute('data-theme', theme);

    // ── Sistema 2: clase CSS .dark (usado por layouts admin.blade.php / Tailwind) ──
    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    // Guardar siempre para que próximas páginas arranquen sincronizadas
    localStorage.setItem('theme', theme);
})();

/**
 * toggleTheme()
 * Llamar desde cualquier botón de la app: onclick="toggleTheme()"
 * Funciona igual en admin y en el home público.
 */
function toggleTheme() {
    const current  = localStorage.getItem('theme') || 'light';
    const newTheme = current === 'dark' ? 'light' : 'dark';

    // Aplicar ambos sistemas
    document.documentElement.setAttribute('data-theme', newTheme);
    if (newTheme === 'dark') {
        document.documentElement.classList.add('dark');
    } else {
        document.documentElement.classList.remove('dark');
    }

    localStorage.setItem('theme', newTheme);

    // Actualizar ícono del botón si existe (clase .theme-icon)
    document.querySelectorAll('.theme-icon').forEach(el => {
        el.textContent = newTheme === 'dark' ? '☀️' : '🌙';
    });
}

// Al cargar la página, sincronizar íconos
document.addEventListener('DOMContentLoaded', function () {
    const theme = localStorage.getItem('theme') || 'light';
    document.querySelectorAll('.theme-icon').forEach(el => {
        el.textContent = theme === 'dark' ? '☀️' : '🌙';
    });
});
