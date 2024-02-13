/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./index.html",
    "./src/**/*.{vue,js,ts,jsx,tsx}",
  ],
  theme: {
    extend: {
      fontFamily: {
        TrainOne: ['Train One', 'system-ui'],
        inter: ['Inter', 'sans-serif']
      },
      colors: {
        'curry': 'rgba(220, 192, 159, 1)'
      }
    },
  },
  plugins: [],
}