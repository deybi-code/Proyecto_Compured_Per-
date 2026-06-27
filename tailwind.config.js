module.exports = {
  darkMode: 'class',
  content: [
    './vendor/laravel/framework/src/Illuminate/Pagination/resources/views/*.blade.php',
    './storage/framework/views/*.php',
    './resources/views/**/*.blade.php',
    './resources/js/**/*.js',
  ],
  theme: {
    extend: {
      colors: {
        primary: {
          light: '#3b82f6',
          dark: '#1e40af',
        }
      }
    },
  },
  plugins: [],
};
