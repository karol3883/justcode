// /** @type {import('tailwindcss').Config} */
// module.exports = {
//   content: ["./templates/*.{html,js}"],
//   theme: {
//     extend: {
//
//     },
//   },
//   plugins: [],
// }

import('tailwindcss').Config
// module.exports = {
//   // content: ['./src/**/*.{html,js}'],
//   // content: ["./templates/*.twig"],
//   content: ["./templates/**/*.twig"],
//   // content: ["./templates/base.html.twig"],
//
//   theme: {
//     // colors: {
//     //   'gray': [
//     //
//     //   ],
//     //   'blue': '#1fb6ff',
//     //   'blue-800': '#1fb6ff',
//     //   'purple': '#7e5bef',
//     //   'pink': '#ff49db',
//     //   'orange': '#ff7849',
//     //   'green': '#13ce66',
//     //   'yellow': '#ffc82c',
//     //   'gray-dark': '#273444',
//     //   'gray-light': '#d3dce6',
//     // },
//     fontFamily: {
//       sans: ['Graphik', 'sans-serif'],
//       serif: ['Merriweather', 'serif'],
//     },
//     extend: {
//       spacing: {
//         '8xl': '96rem',
//         '9xl': '128rem',
//       },
//       borderRadius: {
//         '4xl': '2rem',
//       }
//     }
//   },
// }


const defaultTheme = require("tailwindcss/defaultTheme");
const colors = require('tailwindcss/colors')

module.exports = {
  content: ["./templates/**/*.twig"],
  safelist: ["active"],
  theme: {
    fontFamily: {
      header: ["Raleway", "sans-serif"],
      body: ["Open Sans", "sans-serif"],
    },

    screens: {
      xs: "375px",
      ...defaultTheme.screens,
    },

    extends: {
      colors: {
        transparent: "transparent",
        primary: "#5540af",
        secondary: "#252426",
        white: "#ffffff",
        black: "#000000",
        yellow: "#f9e71c",
        lila: "#e6e5ec",
        "grey-10": "#6c6b6d",
        "grey-20": "#7c7c7c",
        "grey-30": "#919091",
        "gray-400": "#929293",
        "grey-50": "#f4f3f8",
        "grey-60": "#edebf6",
        "grey-70": "#d8d8d8",
        "hero-gradient-from": "rgba(85, 64, 174, 0.95)",
        "hero-gradient-to": "rgba(65, 47, 144, 0.93)",
        "blog-gradient-from": "#8f9098",
        "blog-gradient-to": "#222222",
      },
    },

    container: {
      center: true,
      padding: "1rem",
    },

    shadows: {
      default: "0 2px 18px rgba(0, 0, 0, 0.06)",
      md: "0 -3px 36px rgba(0, 0, 0, 0.12)",
    },

    extend: {
      spacing: {
        13: "3.25rem",
        15: "3.75rem",
        17: "4.25rem",
        18: "4.5rem",
        19: "4.75rem",
        42: "10.5rem",
        76: "19rem",
        84: "21rem",
        88: "22rem",
        92: "23rem",
        100: "25rem",
        104: "26rem",
        108: "27rem",
        112: "28rem",
        116: "29rem",
        120: "30rem",
        124: "31rem",
        128: "32rem",
        132: "33rem",
        136: "34rem",
        140: "35rem",
        144: "36rem",
        148: "37rem",
        152: "38rem",
        156: "39rem",
        160: "40rem",
        164: "41rem",
        168: "42rem",
        172: "43rem",
        176: "44rem",
        180: "45rem",
        184: "46rem",
        188: "47rem",
        190: "48rem",
        194: "49rem",
        200: "50rem",
        204: "51rem",
      },
      zIndex: {
        "-1": "-1",
        60: "60",
        70: "70",
      },
      inset: {
        "2/5": "40%",
      },
    },
  },
};
