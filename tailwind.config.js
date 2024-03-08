// /** @type {import('tailwindcss').Config} */
// module.exports = {
//   content: [],
//   theme: {
//     extend: {},
//   },
//   plugins: [],
// }

/** @type {import('tailwindcss').Config} */
export default {
  content: [
    "./resources/**/*.{blade.php, vue, js}"
  ],
  theme: {
    screens:{
        sm: '576px',
        md: '768px',
        lg: '992px',
        xl: '1200px'
    },
    container:{
        center: true,
        padding: '6rem'
    },
    colors:{
        'primary' : '#FD3D57'
    },
    extend: {
        fontFamily:{
            montserrat:"'Montserrat', sans-serif",
            roboto:"'Roboto', sans-serif"
        }
    },
  },
  variants: {
    extends: {
        display: ['group-hover']
    }
  },
  plugins: [require('@tailwindcss/forms')],
}

