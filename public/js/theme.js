// public/js/theme.js

// 1. Función que aplica los colores inmediatamente
function applyTheme() {
    const theme = localStorage.getItem('theme') || 'light';

    if (theme === 'dark') {
        document.documentElement.classList.add('dark');
        document.documentElement.setAttribute('data-theme', 'dark');
        document.body.classList.add('dark-mode'); // Para tu CSS nativo
    } else {
        document.documentElement.classList.remove('dark');
        document.documentElement.setAttribute('data-theme', 'light');
        document.body.classList.remove('dark-mode'); // Para tu CSS nativo
    }
}

// 2. Ejecutar de inmediato (evita el parpadeo blanco al cargar la página)
applyTheme();

// 3. Función vinculada al botón del sol/luna
function toggleDarkMode() {
    const currentTheme = localStorage.getItem('theme') || 'light';
    const newTheme = currentTheme === 'dark' ? 'light' : 'dark';

    localStorage.setItem('theme', newTheme);
    applyTheme(); // Aplica el cambio en la pestaña actual
}

// 4. EL TRUCO DE MAGIA: Escuchar cambios en otras pestañas abiertas
window.addEventListener('storage', (e) => {
    if (e.key === 'theme') {
        applyTheme(); // Si apagas la luz en otra pestaña, se apaga aquí también
    }
});
