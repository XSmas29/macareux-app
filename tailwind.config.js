/** @type {import('tailwindcss').Config} */

export default {
  content: [
    './resources/**/*.blade.php',
    './resources/**/*.js',
    './resources/**/*.html',
  ],
  theme: {
    extend: {},
  },
  plugins: [require('daisyui')],
}

