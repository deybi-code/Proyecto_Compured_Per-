// tailwind.config.js
module.exports = {
  darkMode: 'selector', // Esto permite controlar el modo oscuro mediante la clase 'dark' en el elemento html
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        // Define aquí los colores base de tu marca que vimos en el video
        primary: {
          light: '#3b82f6',
          dark: '#1e40af',
        }
      }
    },
  },
  plugins: [],
};
