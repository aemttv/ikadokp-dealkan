/** @type {import('tailwindcss').Config} */
module.exports = {
    content: [
      "./resources/**/*.blade.php",
      "./resources/**/*.js",
      "./resources/**/*.vue",
      "./node_modules/flowbite/**/*.js"
    ],
    theme: {
      extend: {
        fontFamily: {
            poppins: ['Poppins', 'sans-serif'],
          },
        colors: {
            primary: "#F68A1F",
            white: "#FFFFFF",
            black: "#000000",
            background: "#F7F7F7",
            hoverColor: "#f77b00"
          },
      },
    },
    plugins: [
        require('flowbite/plugin')
    ],
    darkMode: false,
  }
