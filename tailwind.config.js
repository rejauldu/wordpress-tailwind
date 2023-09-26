/** @type {import('tailwindcss').Config} */
module.exports = {
  content: ["./**/*.php","./**/*.ts","./**/*.tsx","./**/*.svg"],
  theme: {
    extend: {
      colors: {
        'theme': {
          'primary': '#63cb8d',
          'light': '#e0faeb',
          'secondary': '#FF7100'
        }
      }
    },
  },
  plugins: [],
}

