/** @type {import('tailwindcss').Config} */
module.exports = {
  content: [
    "./resources/**/*.blade.php",
    "./resources/**/*.js",
    "./resources/**/*.vue",
  ],
    theme: {
        extend: {
            colors: {
                owngray: "#EDEDED",
                navInfoGray: "#737373",
                primary: "#DFBE65",
                "primary-darker": "#DAA515",
            },
            fontFamily: {
                montserrat: ["Montserrat", "sans-serif"],
                poppins: ["Poppins", "sans-serif"],
            },
            screens: {
                "2xs": "321px",
                xs: "426px",
            },
        },
    },
    plugins: [],
};
