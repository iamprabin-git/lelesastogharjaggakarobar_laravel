/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.{js,ts,jsx,tsx}",
    "./resources/**/*.vue",
    "./node_modules/flowbite/**/*.js",  // important for flowbite
  ],
  theme: { extend: {} },
  plugins: [
    require('@tailwindcss/forms'),
    require('flowbite/plugin'),
  ],
}
