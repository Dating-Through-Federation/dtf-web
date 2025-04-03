/** @type {import('tailwindcss').Config} */
const colors = require("tailwindcss/colors");
module.exports = {
  content: ["./assets/**/*.js", "./templates/**/*.html.twig"],
  theme: {
    colors: {
      transparent: "transparent",
      current: "currentColor",
      black: colors.black,
      white: colors.white,
      rose: colors.rose,
      pink: colors.pink,
      fuchsia: colors.fuchsia,
      purple: colors.purple,
      violet: colors.violet,
      indigo: colors.indigo,
      blue: colors.blue,
      // lightBlue: colors.lightBlue, // Only in Tailwind CSS <=v2.1
      sky: colors.sky, // As of Tailwind CSS v2.2, `lightBlue` has been renamed to `sky`
      cyan: colors.cyan,
      teal: colors.teal,
      emerald: colors.emerald,
      green: colors.green,
      lime: colors.lime,
      yellow: colors.yellow,
      amber: colors.amber,
      orange: colors.orange,
      red: colors.red,
      slate: colors.slate,
      zinc: colors.zinc,
      gray: colors.gray,
      neutral: colors.slate,
      stone: colors.stone,
      lunaprime: "#632e9b",
      lunasecond: "#38216d",
      lunathird: "#e0d3ff",
      lunafour: "#c2a6ff",
      lunafive: colors.white,
    },
    variants: {},
    plugins: [],
    extend: {},
  },
  plugins: [require("@tailwindcss/forms")],
};

