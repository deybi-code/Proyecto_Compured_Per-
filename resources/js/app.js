import './bootstrap';

// ===== COMPURED PERÚ - DARK MODE =====
window.toggleDark = function() {
  const html = document.documentElement;
  const isDark = html.classList.toggle('dark');
  localStorage.setItem('cpTheme', isDark ? 'dark' : 'light');
  // Actualizar ícono del botón si existe
  const icon = document.getElementById('theme-icon');
  if (icon) {
    icon.textContent = isDark ? '☀️' : '🌙';
  }
};

// Inicializar al cargar
document.addEventListener('DOMContentLoaded', function() {
  const savedTheme = localStorage.getItem('cpTheme') || 'light';
  if (savedTheme === 'dark') {
    document.documentElement.classList.add('dark');
  }
  const icon = document.getElementById('theme-icon');
  if (icon) {
    icon.textContent = document.documentElement.classList.contains('dark') ? '☀️' : '🌙';
  }

  // Animaciones de entrada para tarjetas
  const cards = document.querySelectorAll('.product-card');
  const observer = new IntersectionObserver((entries) => {
    entries.forEach((entry, i) => {
      if (entry.isIntersecting) {
        entry.target.style.animationDelay = (i % 6 * 0.06) + 's';
        entry.target.classList.add('fade-in-up');
        observer.unobserve(entry.target);
      }
    });
  }, { threshold: 0.1 });
  cards.forEach(card => observer.observe(card));

  // Smooth reveal para el header
  const header = document.querySelector('.site-header');
  if (header) {
    let lastY = 0;
    window.addEventListener('scroll', () => {
      const y = window.scrollY;
      if (y > 80) {
        header.style.boxShadow = '0 4px 20px rgba(0,82,204,0.15)';
      } else {
        header.style.boxShadow = '';
      }
      lastY = y;
    }, { passive: true });
  }

  // Agregar ripple a botones primarios
  document.querySelectorAll('.btn-primary, .btn-cart').forEach(btn => {
    btn.addEventListener('click', function(e) {
      const ripple = document.createElement('span');
      const rect = btn.getBoundingClientRect();
      ripple.style.cssText = `
        position:absolute; border-radius:50%;
        background:rgba(255,255,255,0.4);
        width:100px; height:100px;
        left:${e.clientX - rect.left - 50}px;
        top:${e.clientY - rect.top - 50}px;
        transform:scale(0); animation:ripple-effect 0.5s linear;
        pointer-events:none;
      `;
      if (!btn.style.position) btn.style.position = 'relative';
      btn.style.overflow = 'hidden';
      btn.appendChild(ripple);
      setTimeout(() => ripple.remove(), 600);
    });
  });
});

// CSS para ripple
const style = document.createElement('style');
style.textContent = `@keyframes ripple-effect { to { transform: scale(4); opacity: 0; } }`;
document.head.appendChild(style);
