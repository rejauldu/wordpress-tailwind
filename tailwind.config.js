/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php","./**/*.ts","./**/*.tsx","./**/*.svg"],
  theme: {
    extend: {
      colors: {
        'theme': {
          'primary': '#00a651',
          'light': '#e0faeb7d',
          'secondary': '#FF7100'
        }
      }
    },
  },
  plugins: [
    require('tailwindcss-line-clamp')
  ],
}

