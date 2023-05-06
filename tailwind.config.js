/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./view/**/*.{html,js,php}",
    "./index.html",
  ],
  theme: {
    extend: {},
  },
  plugins: [
    require("@tailwindcss/typography"),
    require("daisyui")
  ],
}

