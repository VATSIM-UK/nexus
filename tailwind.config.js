module.exports = {
  content: [
    './resources/views/**/*.blade.php',
    './resources/js/**/*.vue',
  ],
  theme: {
    extend: {
      colors: {
        'uk-blue': '#25ADE3',
      },
    },
  },
  plugins: [
    require('@tailwindcss/forms'),
  ],
}
