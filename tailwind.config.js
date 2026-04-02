/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./index.html",         // Looks at index.html in the root
    "./*.{html,js}",        // Looks at any other HTML/JS files in the root
    "./pages/**/*.{html,js}" // Optional: Looks inside a 'pages' folder if you make one
  ],
  theme: {
    extend: {
      fontFamily: {
        montserrat: ['Montserrat', 'sans-serif'],
      },
    },
  },
  plugins: [],
}