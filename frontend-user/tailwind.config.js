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
        body: ['Noto Sans JP', 'Inter', 'sans-serif'],
      },
      colors: {
        'curry': 'rgba(220, 192, 159, 1)',
        'main': 'rgba(3, 10, 18, .81)',
        'utility': '#798184',
        'sumi': {
          50: '#F8F8FB',
          100: '#F1F1F4',
          200: '#E8E8EB',
          300: '#D8D8DB',
          400: '#B4B4B7',
          500: '#949497',
          600: '#757578',
          700: '#626264',
          800: '#414143',
          900: '#1A1A1C',
          1000: '#111111',
          1100: '#080808',
          1200: '#000000'
        },
      },
      fontSize: {
        mini: '0.625rem',
      },
    },
  },
  plugins: [],
}